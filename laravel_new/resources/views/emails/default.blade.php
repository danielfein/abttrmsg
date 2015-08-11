@extends('layouts.email')

@section('content')
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="width:100%;background-color:#ffffff;text-align:left;margin:0 auto;max-width:1024px;min-width:320px;border: 1px solid #ddd;">
    <tbody>
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:100%;background-color:#ffffff;padding:0;border-bottom:1px solid #ddd">
                    <tbody>
                        <tr>
                            <td>
                                <h2 style="padding:0;margin:10px 20px;font-size:16px;line-height:1.4em;font-weight:bold;color:#464646;font-family:'Helvetica Neue', Helvetica,Arial,sans-serif">
                                    Testing mail
                                </h2>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:100%" width="100%" border="0" cellspacing="0" cellpadding="20" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td>
                                <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>

                                            <td valign="top" style="padding:0 0 0 20px">
                                                <p style="direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0">
                                                    Hello,<br/><br/>

                                                    You have new message..                                   
                                                </p>

                                                <p style="direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0">
                                                    Click the link below to view message.
                                                </p>

                                                <div style="direction:ltr;margin:0 0 20px 0;font-size:14px;">
                                                    <p style="direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;margin:0 0 1em 0">
                                                        <a href="{{$link}}"> Click hear</a>
                                                    </p>
                                                </div>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table border="0" cellspacing="0" width="100%" cellpadding="20" bgcolor="#f6f7f8" style="width:100%;background-color:#f6f7f8;text-align:left;border-top:1px solid #dddddd">
                    <tbody>
                        <tr>
                            <td style="border-top:1px solid #f3f3f3;color:#888;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;background:#efefef;margin:0;padding:10px 20px 20px">
                                <p style="direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;margin:0 0 1em 0;font-size:12px;line-height:1.4em;margin:0 0 0 0">
                                    <strong>Trouble clicking?</strong> Copy and paste this URL into your browser: <br>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
@stop