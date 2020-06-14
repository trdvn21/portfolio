from django.test import TestCase
from django.urls import reverse
import json
import sys

import uclf.settings as settings
sys.path.append(settings.BASE_DIR)

from utils.common import SocialPlatformName

from utils import setup_django
from account.models import CustomUser
from publishing.models import Post


class DeletePostView_Test(TestCase):
    """Test views.delete_post()"""

    @classmethod
    def setUpTestData(cls):
        Post.objects.all().delete()
        cls.username = 'TestUser'
        cls.password = '12345'
        cls.user = CustomUser.objects.create_user(
            username=cls.username,
            password=cls.password
        )

    def test_delete_existing_post(self):
        login = self.client.login(username=self.username, password=self.password)
        self.assertTrue(login)

        # Create a new post
        response = self.client.post(
            reverse('publishing:publish_post'),
            {
                'id': '',
                'msg': 'test_delete_existing_post'
            }
        )
        response_data = json.loads(response.content)
        self.assertEqual(response_data['status'], 'success')

        # Delete the post
        post_id = response_data['post_id']
        response = self.client.post(
            reverse('publishing:delete_post'),
            {
                'id': post_id
            }
        )
        self.assertEqual(response.status_code, 200)
        response_data = json.loads(response.content)
        self.assertEqual(response_data['status'], 'success')

        # Verify post updated in database
        try:
            post = Post.objects.get(pk=post_id)
            self.fail()
        except Post.DoesNotExist:
            self.assertTrue(True)


    def test_access_without_login(self):
        response = self.client.get(reverse('publishing:delete_post'))
        self.assertEqual(response.status_code, 302)


class PublishPostView_Test(TestCase):
    """Test views.publish_post()"""

    @classmethod
    def setUpTestData(cls):
        Post.objects.all().delete()
        cls.username = 'TestUser'
        cls.password = '12345'
        cls.user = CustomUser.objects.create_user(
            username=cls.username,
            password=cls.password
        )


    def test_update_existing_post(self):
        login = self.client.login(username=self.username, password=self.password)
        self.assertTrue(login)

        # Create a new post
        response = self.client.post(
            reverse('publishing:publish_post'),
            {
                'id': '',
                'msg': 'test_update_existing_post'
            }
        )
        response_data = json.loads(response.content)
        self.assertEqual(response_data['status'], 'success')

        # Update the post
        post_id = response_data['post_id']
        response = self.client.post(
            reverse('publishing:publish_post'),
            {
                'id': post_id,
                'msg': 'test_update_existing_post update'
            }
        )
        self.assertEqual(response.status_code, 200)
        response_data = json.loads(response.content)
        self.assertEqual(response_data['status'], 'success')

        # Verify post updated in database
        try:
            post = Post.objects.get(pk=post_id)
            self.assertEqual(post.message, 'test_update_existing_post update')
        except Exception as e:
            self.fail(str(e))


    def test_create_new_post(self):
        login = self.client.login(username=self.username, password=self.password)
        self.assertTrue(login)
        response = self.client.post(
            reverse('publishing:publish_post'),
            {
                'id': '',
                'msg': 'test_create_new_post'
            }
        )
        self.assertEqual(response.status_code, 200)
        response_data = json.loads(response.content)
        self.assertEqual(response_data['status'], 'success')

        # Verify a new post created in database
        try:
            post = Post.objects.get(pk=response_data['post_id'])
            self.assertTrue(True)
        except Exception as e:
            self.fail(str(e))


    def test_empty_post_message(self):
        login = self.client.login(username=self.username, password=self.password)
        self.assertTrue(login)
        response = self.client.post(
            reverse('publishing:publish_post'),
            {
                'id': '',
                'msg': ''
            }
        )
        response_data = json.loads(response.content)
        self.assertEqual(response_data['status'], 'failure')
        self.assertEqual(response_data['message'], 'Please enter a message')


    def test_access_without_login(self):
        response = self.client.get(reverse('publishing:publish_post'))
        self.assertEqual(response.status_code, 302)


class IndexView_Test(TestCase):
    """Test views.index()"""

    @classmethod
    def setUpTestData(cls):
        Post.objects.all().delete()
        cls.username = 'TestUser'
        cls.password = '12345'
        cls.user = CustomUser.objects.create_user(
            username=cls.username,
            password=cls.password
        )


    def test_user_with_posts(self):
        Post.objects.create(
            user=self.user,
            platform=SocialPlatformName.FACEBOOK,
            message='Chelsea - Barca'
        )
        Post.objects.create(
            user=self.user,
            platform=SocialPlatformName.TWITTER,
            message='UCL Final will be on May 26.'
        )

        login = self.client.login(username=self.username, password=self.password)
        self.assertTrue(login)
        response = self.client.get(reverse('publishing:index'))
        self.assertEqual(response.status_code, 200)
        self.assertQuerysetEqual(
            response.context['posts'],
            ['<Post: UCL Final will be on May 26.... (TestUser@Twitter)>',
             '<Post: Chelsea - Barca... (TestUser@Facebook)>']
        )
        self.assertEqual(len(response.context['messages']), 0)


    def test_user_with_no_posts(self):
        login = self.client.login(username=self.username, password=self.password)
        self.assertTrue(login)
        response = self.client.get(reverse('publishing:index'))
        self.assertEqual(response.status_code, 200)
        self.assertQuerysetEqual(response.context['posts'], [])
        self.assertEqual(len(response.context['messages']), 0)


    def test_access_without_login(self):
        response = self.client.get(reverse('publishing:index'))
        self.assertEqual(response.status_code, 302)