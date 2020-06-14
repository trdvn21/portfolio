from django.urls import path

from django.contrib.auth import views as auth_views
from . import views

app_name = 'publishing'
urlpatterns = [
    path('', views.index, name='index'),
    path('publish_post/', views.publish_post, name='publish_post'),
    path('delete_post/', views.delete_post, name='delete_post'),
]