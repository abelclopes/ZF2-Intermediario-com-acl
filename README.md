ZendSkeletonApplication
=======================
URL Serviços
------------

http://zf2.intermediario/admin


-- sonuser
http://zf2.intermediario/auth ( Login )
http://zf2.intermediario/register ( Registrar )
http://zf2.intermediario/auth/logout ( Logout )
http://zf2.intermediario/register/activate/b0f51894777eb51f063316cbc6ff158d  ( Ativando usuário )
http://zf2.intermediario/admin/ ( Admin )
http://zf2.intermediario/admin/users/edit/1
http://zf2.intermediario/admin/users/new

-- sonuser-rest
http://zf2.intermediario/api/user
http://zf2.intermediario/api/user/2

-- sonuser-acl
http://zf2.intermediario/admin/acl
http://zf2.intermediario/admin/acl/roles/edit/1
http://zf2.intermediario/admin/acl/roles/new




Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the `create-project` command:

    curl -s https://getcomposer.org/installer | php --
    php composer.phar create-project --repository-url="http://packages.zendframework.com" zendframework/skeleton-application path/to/install

Alternately, clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/project/dir
    git clone git://github.com/zendframework/ZendSkeletonApplication.git
    cd ZendSkeletonApplication
    php composer.phar self-update
    php composer.phar install

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)

Another alternative for downloading the project is to grab it via `curl`, and
then pass it to `tar`:

    cd my/project/dir
    curl -#L https://github.com/zendframework/ZendSkeletonApplication/tarball/master | tar xz --strip-components=1

You would then invoke `composer` to install dependencies per the previous
example.

Using Git submodules
--------------------
Alternatively, you can install using native git submodules:

    git clone git://github.com/zendframework/ZendSkeletonApplication.git --recursive

Virtual Host
------------
Afterwards, set up a virtual host to point to the public/ directory of the
project and you should be ready to go!
