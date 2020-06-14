from django.shortcuts import render
from django.template import loader
from django.contrib import messages
from django.http import HttpResponse
from django.http import JsonResponse
from django.urls import reverse
from django.contrib.auth.decorators import login_required
import sys

import uclf.settings as settings
sys.path.append(settings.BASE_DIR)

import publishing.views_helper as views_helper
from publishing.models import Post

# Get setting parameters
SETTINGS = settings.SETTINGS


@login_required
def index(request):
    """Publishing home page"""

    # Get posts of this user in inverse chronological order
    user = request.user
    posts = Post.objects.filter(user=user).order_by('-created_date')

    template = loader.get_template('publishing/index.html')
    context = {
        'posts': posts,
        'messages': messages.get_messages(request),
    }
    return HttpResponse(template.render(context, request))


@login_required
def publish_post(request):
    """Create or update posts to social media"""

    post_id = request.POST.get('id', None)
    post_message = request.POST.get('msg', None)

    response_data = {}
    if not post_message:
        response_data['status'] = 'failure'
        response_data['message'] = 'Please enter a message'
        return JsonResponse(response_data)

    if post_id:
        # Update existing post
        try:
            views_helper.update_facebook_post(post_id, post_message)
            response_data['status'] = 'success'
            response_data['message'] = 'Successfully updated to Facebook'
        except Exception as e:
            response_data['status'] = 'failure'
            response_data['message'] = 'Failed to update to Facebook: %s' % str(e)
        finally:
            return JsonResponse(response_data)
    else:
        # Create new post
        try:
            user = request.user
            post = views_helper.create_facebook_post(user, post_message)
            response_data['status'] = 'success'
            response_data['post_id'] = post.id
            response_data['message'] = 'Successfully posted to Facebook'
        except Exception as e:
            response_data['status'] = 'failure'
            response_data['message'] = 'Failed to post to Facebook: %s' % str(e)
        finally:
            return JsonResponse(response_data)



@login_required
def delete_post(request):
    """Delete posts on social media"""

    post_id = request.POST.get('id', None)
    response_data = {}
    try:
        views_helper.delete_facebook_post(post_id)
        response_data['status'] = 'success'
        response_data['message'] = 'Successfully deleted post on Facebook'
    except Exception as e:
        response_data['status'] = 'failure'
        response_data['message'] = 'Failed to deleted post on Facebook: %s' % str(e)
    finally:
        return JsonResponse(response_data)
