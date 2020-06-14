from django.test import TestCase
import sys

import uclf.settings as settings
sys.path.append(settings.BASE_DIR)

from utils.common import SocialPlatformName
import publishing.views_helper as views_helper

from utils import setup_django
from account.models import CustomUser
from publishing.models import Post


class DeleteFacebookPost_Test(TestCase):
    """Test views_helper.delete_facebook_post()"""

    @classmethod
    def setUpTestData(cls):
        Post.objects.all().delete()
        cls.username = 'TestUser'
        cls.password = '12345'
        cls.user = CustomUser.objects.create_user(
            username=cls.username,
            password=cls.password
        )


    def test_post_deleted_successfully(self):
        post = views_helper.create_facebook_post(
            self.user,
            'test_post_deleted_successfully'
        )

        try:
            views_helper.delete_facebook_post(
                post_id=post.id
            )
            self.assertTrue(True)
        except Exception as e:
            self.fail(str(e))


    def test_post_not_found_on_facebook(self):
        Post.objects.create(
            id=1,
            user=self.user,
            platform=SocialPlatformName.FACEBOOK,
            id_on_platform='UNKNOWN',
            message='test_post_not_found_on_facebook'
        )

        try:
            post = views_helper.delete_facebook_post(
                post_id=1
            )
            self.fail()
        except Exception as e:
            self.assertTrue(True)
            self.assertEqual(str(e), '(#33) This object does not exist or does not support this action')


    def test_post_not_found_in_database(self):
        try:
            post = views_helper.delete_facebook_post(
                post_id=1
            )
            self.fail()
        except Exception as e:
            self.assertTrue(True)
            self.assertEqual(str(e), 'Post matching query does not exist.')


class UpdateFacebookPost_Test(TestCase):
    """Test views_helper.update_facebook_post()"""

    @classmethod
    def setUpTestData(cls):
        Post.objects.all().delete()
        cls.username = 'TestUser'
        cls.password = '12345'
        cls.user = CustomUser.objects.create_user(
            username=cls.username,
            password=cls.password
        )


    def test_post_updated_successfully(self):
        post = views_helper.create_facebook_post(
            self.user,
            'test_post_updated_successfully'
        )

        try:
            post = views_helper.update_facebook_post(
                post_id=post.id,
                post_message='test_post_updated_successfully update'
            )
            self.assertEqual(post.message, 'test_post_updated_successfully update')
        except Exception as e:
            self.fail(str(e))


    def test_post_not_found_on_facebook(self):
        Post.objects.create(
            id=1,
            user=self.user,
            platform=SocialPlatformName.FACEBOOK,
            id_on_platform='UNKNOWN',
            message='test_post_not_found_on_facebook'
        )

        try:
            post = views_helper.update_facebook_post(
                post_id=1,
                post_message='test_post_not_found_on_facebook update'
            )
            self.fail()
        except Exception as e:
            self.assertTrue(True)
            self.assertEqual(str(e), 'Failed to update to Facebook')


    def test_post_not_found_in_database(self):
        try:
            post = views_helper.update_facebook_post(
                post_id=1,
                post_message='test_post_not_found_in_database'
            )
            self.fail()
        except Exception as e:
            self.assertTrue(True)
            self.assertEqual(str(e), 'Post matching query does not exist.')


    def test_missing_post_message(self):
        try:
            post = views_helper.update_facebook_post(
                post_id=1,
                post_message=''
            )
            self.fail()
        except Exception as e:
            self.assertTrue(True)
            self.assertEqual(str(e), 'Missing post message')


class CreateFacebookPost_Test(TestCase):
    """Test views_helper.create_facebook_post()"""

    @classmethod
    def setUpTestData(cls):
        cls.username = 'TestUser'
        cls.password = '12345'
        cls.user = CustomUser.objects.create_user(
            username=cls.username,
            password=cls.password
        )


    def test_post_created_successfully(self):
        try:
            post = views_helper.create_facebook_post(
                user=self.user,
                post_message='test_post_created_successfully'
            )

            Post.objects.get(pk=post.id)
            self.assertTrue(True)
        except Exception as e:
            self.fail(str(e))


    def test_missing_post_message(self):
        try:
            post = views_helper.create_facebook_post(
                user=self.user,
                post_message=''
            )
            self.fail()
        except Exception as e:
            self.assertTrue(True)
            self.assertEqual(str(e), 'Missing post message')


    def test_missing_user(self):
        try:
            post = views_helper.create_facebook_post(
                user=None,
                post_message='test_missing_user'
            )
            self.fail()
        except Exception as e:
            self.assertTrue(True)
            self.assertEqual(str(e), 'Missing user')


