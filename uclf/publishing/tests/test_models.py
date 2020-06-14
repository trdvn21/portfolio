from django.test import TestCase
import sys

import uclf.settings as settings
sys.path.append(settings.BASE_DIR)

from utils import setup_django
from account.models import CustomUser
from publishing.models import Post


class Post_Test(TestCase):
    """Test Post model"""

    @classmethod
    def setUpTestData(cls):
        cls.user = CustomUser.objects.create_user(
            username='TestUser',
            password='12345'
        )

        cls.twitter_post = Post.objects.create(
            user=cls.user,
            platform='Twitter',
            id_on_platform='1234ABCD',
            message='Barca - Juventus today'
        )

        cls.facebook_post = Post.objects.create(
            user=cls.user,
            platform='Facebook',
            message='Match day: Barca - Juventus. Guessing 2 - 2. '
                    'Messi 1 Suarez 1 - CR7 2 (1 penalty). '
                    'So second leg will be decisive.'
        )


    def test_str_long_post(self):
        text = str(self.facebook_post)
        self.assertEqual(text, 'Match day: Barca - Juventus. G... (TestUser@Facebook)')


    def test_str_short_post(self):
        text = str(self.twitter_post)
        self.assertEqual(text, 'Barca - Juventus today... (TestUser@Twitter)')