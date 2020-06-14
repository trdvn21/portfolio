from django.db import models
import sys

import uclf.settings as settings
sys.path.append(settings.BASE_DIR)

from utils.common import SOCIAL_PLATFORM_NAMES, SOCIAL_PLATFORM_NAME_MAX_LENGTH



class Post(models.Model):
    """This model represents a post on social media, such as Facebook or Twitter"""

    class Meta:
        db_table = 'uclf_publishing_post'

    user = models.ForeignKey(
        settings.AUTH_USER_MODEL,
        on_delete=models.SET_NULL,
        null=True,
        verbose_name='User'
    )

    platform = models.CharField(
        verbose_name='Platform',
        choices=SOCIAL_PLATFORM_NAMES,
        max_length=SOCIAL_PLATFORM_NAME_MAX_LENGTH
    )

    id_on_platform = models.CharField(
        verbose_name='Post ID on platform',
        null=True, # if not available
        max_length = 100
    )

    message = models.TextField(
        verbose_name='Post message'
    )

    # Read-only fields
    created_date = models.DateTimeField(
        verbose_name='Created date',
        auto_now_add=True
    )

    modified_date = models.DateTimeField(
        verbose_name='Last modified date',
        auto_now=True
    )

    def __str__(self):
        return '%s... (%s@%s)' % (self.message[:30], self.user.username, self.platform)