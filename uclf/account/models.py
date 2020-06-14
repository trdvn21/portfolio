from django.db import models
from django.contrib.auth.models import AbstractUser



class CustomUser(AbstractUser):
    """Always use this CustomUser for ease of future expansion"""
    pass