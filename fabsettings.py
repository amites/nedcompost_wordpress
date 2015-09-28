from os import path

try:
    from lib.settings_build import Configure
except ImportError:
    import sys
    from os.path import expanduser, join

    sys.path.append(join(expanduser("~"), 'workspace/automation/launchy'))

    from lib.settings_build import Configure


class Default(Configure):
    def __init__(self):
        self.beta = False
        self.local = False

        self.project = 'nedcompost'
        
        self.php = True

        self.database_name = self.project
        self.database_user = self.project
        
        self.path_project_root = path.join('/mnt', self.project)

        self.setDefaults()
        if getattr(self, 'host', False):
            self.setHost()


class Local(Default):
    def __init__(self):
        self.beta = True
        self.local = True

        self.database_root_password = 'password'

        super(Local, self).__init__()


class Production(Default):

    def __init__(self):
        self.host = ['aws-php-3', ]
        self.domain = 'nedcompost.org'

        self.database_root_password = 'password'
        # self.database_password = 'iNcJ%kx87[M>L:!6pkY$fXZIu'
        self.database_password = 'zHR-mp)@ZZydJ=s9R}*S+4,!a'

        super(Production, self).__init__()


class Beta(Default):
    def __init__(self):
        self.beta = True
        self.host = ['aws-php-3', ]
        self.domain = 'nedcompost.mitesdesign.com'

        self.database_root_password = 'password'
        self.database_password = 'zHR-mp)@ZZydJ=s9R}*S+4,!a'

        super(Beta, self).__init__()
    
try:
    from local_settings import *
except ImportError:
    pass