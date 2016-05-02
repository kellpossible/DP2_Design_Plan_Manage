PHP configuration
=================

Error Reporting
------------------
We are using https://github.com/filp/whoops for error reporting.

For the error:
> Uncaught Error: Call to undefined function Symfony\Component\VarDumper\Dumper\iconv_strlen()

I found this solution:
> You have to edit de file /etc/php/php.ini and uncomment the line ;extension=iconv.so , it function for me
