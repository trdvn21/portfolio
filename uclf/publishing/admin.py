from django.contrib import admin

from .models import Post



class PostAdmin(admin.ModelAdmin):
    search_fields = ('message', 'platform', 'user__username', )
admin.site.register(Post, PostAdmin)
