import requests
import facebook
import sys

import uclf.settings as settings
sys.path.append(settings.BASE_DIR)

from utils import setup_django
from utils.common import SocialPlatformName
from publishing.models import Post

# Get setting parameters
SETTINGS = settings.SETTINGS


def delete_facebook_post(post_id):
    """Delete an existing post on Facebook.

    This function also deletes the corresponding post in database.

    Args:
         post_id (string): The ID of the post in database

    Returns:
        This function returns nothing on success

    Raises:
        Exception: Any exception (to be further processed in the caller)
    """

    try:
        post = Post.objects.get(pk=post_id)
        page_access_token = SETTINGS['FACEBOOK_APP']['PAGE_ACCESS_TOKEN']
        graph = facebook.GraphAPI(page_access_token)
        graph.delete_object(post.id_on_platform)
        post.delete()
    except Exception as e:
        raise e



def update_facebook_post(post_id, post_message):
    """Update an existing post on Facebook.

        This function also updates the corresponding post in database.

        Args:
             post_id (string): The ID of the post in database
             post_message (string): The new message of the post

        Returns:
            Post: The updated Post model instance

        Raises:
            Exception: Any exception (to be further processed in the caller)
        """

    if not post_message:
        raise Exception('Missing post message')

    try:
        post = Post.objects.get(pk=post_id)
        url = 'https://graph.facebook.com/v7.0/%s/?message=%s&access_token=%s' % (
            post.id_on_platform,
            post_message,
            SETTINGS['FACEBOOK_APP']['PAGE_ACCESS_TOKEN']
        )
        res = requests.post(url)
        if res.status_code != 200:
            raise Exception('Failed to update to Facebook')

        # Update to database
        post.message = post_message
        post.save()
        return post
    except Exception as e:
        raise e


def create_facebook_post(user, post_message):
    """Create a post to Facebook.

    This function also creates the corresponding post in database.

    Args:
         user (CustomUser): The logged in user
         post_message (string): The message of the post

    Returns:
        Post: A Post model instance representing the post in database

    Raises:
        Exception: Any exception (to be further processed in the caller)
    """

    if not user:
        raise Exception('Missing user')
    if not post_message:
        raise Exception('Missing post message')

    try:
        # Post to Facebook
        page_access_token = SETTINGS['FACEBOOK_APP']['PAGE_ACCESS_TOKEN']
        facebook_page_id = SETTINGS['FACEBOOK_APP']['PAGE_ID']
        graph = facebook.GraphAPI(page_access_token)
        res = graph.put_object(facebook_page_id, "feed", message=post_message)
        post_id_on_platform = res['id']

        # Create post in database
        post = Post.objects.create(
            user=user,
            platform=SocialPlatformName.FACEBOOK,
            id_on_platform=post_id_on_platform,
            message=post_message
        )
        return post
    except Exception as e:
        raise e
