<!DOCTYPE HTML>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                       <td class="header" align="center" style="padding:40px 0; background-color:#f7f9f4;">
                          <a href="/" style="text-decoration:none; font-size:20px; color:#bbbfc3"><strong>
                            資格学習Coord
                          </strong></a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell" align="">
                                        @yield('content')
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:50px 0; background-color:#f7f9f4; color:#bbbfc3;">
                            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="content-cell" align="center">
                                        &copy; {{date('Y')}} Coord. All rights reserved. 
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> 
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
