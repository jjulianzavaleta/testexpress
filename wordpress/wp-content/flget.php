<!-- IE friendly error message walkround.        
     if error message from server is less than   
     512 bytes IE v5+ will use its own error     
     message instead of the one returned by      
     server.                                 --> 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8; IE=EDGE">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <style type="text/css">
            body {
                height: 100%;
                font-family: Roboto, Helvetica, Arial, sans-serif;
                color: #6a6a6a;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            input[type=date], input[type=email], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], select, textarea {
                color: #262626;
                vertical-align: baseline;
                margin: .2em;
                border-style: solid;
                border-width: 1px;
                border-color: #a9a9a9;
                background-color: #fff;
                box-sizing: border-box;
                padding: 2px .5em;
                appearance: none;
                border-radius: 0;
            }
            input:focus {
                border-color: #646464;
                box-shadow: 0 0 1px 0 #a2a2a2;
                outline: 0;
            }
            button {
                padding: .5em 1em;
                border: 1px solid;
                border-radius: 3px;
                min-width: 6em;
                font-weight: 400;
                font-size: .8em;
                cursor: pointer;
            }
            button.primary {
                color: #fff;
                background-color: rgb(47, 113, 178);
                border-color: rgb(34, 103, 173);
            }
            .message-container {
                height: 500px;
                width: 600px;
                padding: 0;
                margin: 10px;
            }
            .logo {
                background: url(http://url.fortinet.net:8008/XX/YY/ZZ/CI/MGPGHGPGPFGHDDPFGGHGFHBGCHEGPFBGAHAH) no-repeat left center;
                height: 267px;
                object-fit: contain;
            }
            table {
                background-color: #fff;
                border-spacing: 0;
                margin: 1em;
            }
            table > tbody > tr > td:first-of-type:not([colspan]) {
                white-space: nowrap;
                color: rgba(0,0,0,.5);
            }
            table > tbody > tr > td:first-of-type {
                vertical-align: top;
            }
            table > tbody > tr > td {
                padding: .3em .3em;
            }
            .field {
                display: table-row;
            }
            .field > :first-child {
                display: table-cell;
                width: 20%;
            }
            .field.single > :first-child {
                display: inline;
            }
            .field > :not(:first-child) {
                width: auto;
                max-width: 100%;
                display: inline-flex;
                align-items: baseline;
                virtical-align: top;
                box-sizing: border-box;
                margin: .3em;
            }
            .field > :not(:first-child) > input {
                width: 230px;
            }
            .form-footer {
                display: inline-flex;
                justify-content: flex-start;
            }
            .form-footer > * {
                margin: 1em;
            }
            .text-scrollable {
                overflow: auto;
                height: 150px;
                border: 1px solid rgb(200, 200, 200);
                padding: 5px;
                font-size: 1em;
            }
            .text-centered {
                text-align: center;
            }
            .text-container {
                margin: 1em 1.5em;
            }
            .flex-container {
                display: flex;
            }
            .flex-container.column {
                flex-direction: column;
            }
        </style>
        <title>Web Filter Violation</title>
    </head>
    <body><div class="message-container">
    <div class="logo"></div>
    <h1>FortiGuard Intrusion Prevention - Access Blocked</h1>
    <h3>Web Page Blocked</h3>
    <p>You have tried to access a web page that is in violation of your Internet usage policy.</p>
    <table><tbody>
        <tr>
            <td>Category</td>
            <td>Malicious Websites</td>
        </tr>
        <tr>
            <td>URL</td>
            <td>http://198.245.50.141/flget.txt</td>
        </tr>
        <tr>
            <td>Username</td>
            <td></td>
        </tr>
        <tr>
            <td>Group Name</td>
            <td></td>
        </tr>
    </tbody></table>
    <p>To have the rating of this web page re-evaluated <a href="http://url.fortinet.net/rate/submit.php?id=14026C50735A521F78723C6D756E3929&cat=1A&loc=http://198%2e245%2e50%2e141%2fflget%2etxt&ver=8">please click here</a>.</p>
    <p></p>
</div></body>
</html>

