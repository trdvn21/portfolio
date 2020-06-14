"""Set DJANGO_SETTINGS_MODULE to the settings of project.

Run django.setup() just to make it possible to run standalone scripts.
For example: to run standalone scrips or unit tests that access the models.

"""

import os
import django
os.environ['DJANGO_SETTINGS_MODULE'] = 'uclf.settings'
django.setup()
