<style type="text/css">
    #mvvwo_floating_button {
        bottom: 20px;
        right: 15px;
        position: fixed;
        z-index: 9999;
		cursor: pointer;
    }

    #mvvwo_floating_button svg {
        fill: <?php echo $config['floating']['design']['iconColor']; ?>;
    }

    #mvvwo_floating_button:hover {

    }

    #mvvwo_floating_button .mvvwo_txt {
        display: inline-block;
        vertical-align: bottom;
        line-height: 60px;
        opacity: 0;
        transition: opacity 500ms ease-in;
    }

    #mvvwo_floating_button.mvvwo_show .mvvwo_txt {
        opacity: 1;
    }

    #mvvwo_floating_button .mvvwo_txt a {
        background: <?php echo $config['floating']['design']['txtBg']; ?>;
        box-shadow: 0px 0px 5px 0px rgba(136, 136, 136, 0.50);
        padding: 3px 10px;
        border-radius: 5px;
        color: <?php echo $config['floating']['design']['txtColor']; ?>;
        text-decoration: none;
        position: relative;
    }

    #mvvwo_floating_button .mvvwo_txt a:after {
        content: '';
        position: absolute;
        background: <?php echo $config['floating']['design']['txtBg']; ?>;

        right: -5px;
        top: 50%;
        margin-top: -4px;
        width: 8px;
        height: 8px;
        z-index: 1;
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    #mvvwo_floating_button.mvvwo_pos_left .mvvwo_txt a:after {
        left: -4px;
    }

    #mvvwo_floating_button .mvvwo_btn {
        display: inline-block;
        width: <?php echo isset($config['floating']['size']['width'])?$config['floating']['size']['width']:60; ?>px;
        height: <?php echo isset($config['floating']['size']['height'])?$config['floating']['size']['width']:60; ?>px;
        background: <?php echo $config['floating']['design']['bg']; ?>;
        border-radius: 50%;
        padding: <?php echo isset($config['floating']['size']['padding'])?$config['floating']['size']['padding']:13; ?>px;
        box-shadow: 0px 0px 7px 2px rgba(136, 136, 136, 0.50);
        transform: scale3d(0, 0, 0);
        transition: transform .3s ease-in-out;
        transform-origin: 100% 100%;
        margin: 0 5px;
        box-sizing: border-box;
    }

    #mvvwo_floating_button.mvvwo_pos_left .mvvwo_btn {
        transform-origin: 0% 100%;
    }

    #mvvwo_floating_button.mvvwo_show a.mvvwo_btn {
        transform: scale3d(1, 1, 1);
    }

    #mvvwo_floating_button.mvvwo_pos_left {
        right: auto;
        left: 10px;
    }

    @media (max-width: 480px) {
        #mvvwo_floating_button {
            bottom: 10px;
            right: 10px;
        }
    }

    .mvvwo_cart_page_button {
        margin: 7px 0px;
    }

    .mvvwo_cart_button {
        display: block;
        clear: both;
        padding: 10px 0;
    }

    .mvvwo_cart_button a {
        background: <?php echo $config['product']['design']['bg']; ?>;
        padding: 6px 8px;
        display: inline-block;
        border-radius: 6px;
        color: <?php echo $config['product']['design']['textColor']; ?>;
        text-decoration: none !important;
        font-size: 14px;
        line-height:25px;
    }

    .mvvwo_cart_button svg {
        fill: <?php echo $config['product']['design']['iconColor']; ?>;
        width: 25px;
        vertical-align: middle;
        margin-right: 5px;
        display: inline-block;
        margin-top: -5px;
    }

    <?php
if (isset($config['cart']) && $config['cart']['enable']) {

 ?>
    .mvvwo_cart_page_button a {
        background: <?php echo $config['cart']['design']['bg']; ?> !important;
        padding: 6px 8px;
        display: inline-block;
        border-radius: 6px;
        color: <?php echo $config['cart']['design']['textColor']; ?> !important;
        text-decoration: none !important;
        font-size: 14px;
        line-height:25px;
    }

    .mvvwo_cart_page_button svg {
        fill: <?php echo $config['cart']['design']['iconColor']; ?>;
        width: 25px;
        vertical-align: middle;
        margin-right: 5px;
        display: inline-block;
        margin-top: -5px;
    }

    <?php
  }
   ?>

    @media (min-width: 1281px) {
    <?php
     if($config['floating']['hideDesktop']){
        ?>
        #mvvwo_floating_button {
            display: none;
        }

    <?php
         }
           if($config['product']['hideDesktop']){
        ?>
        .mvvwo_cart_button {
            display: none;
        }

    <?php
         }
 ?>

    }

    .mvvwo_whatsbutton {
        margin: 7px 0px;
    }

    .mvvwo_whatsbutton a {
        background: <?php echo $config['shortcode']['design']['bg']; ?>;
        padding: 6px 8px;
        display: inline-block;
        border-radius: 6px;
        text-decoration: none !important;
        color: <?php echo $config['shortcode']['design']['textColor']; ?>;
        text-decoration: none;
        font-size: 14px;
    }

    .mvvwo_whatsbutton svg {
        fill: <?php echo $config['shortcode']['design']['iconColor']; ?>;
        width: 25px;
        vertical-align: middle;
        margin-right: 5px;
        display: inline-block;

    }

    @media (min-width: 1281px) {

    <?php

           if($config['shortcode']['hideDesktop']){
        ?>
        .mvvwo_whatsbutton {
            display: none;
        }

    <?php
         }
 ?>

    }
</style>
<?php
if (isset($config['chatBox']) && $config['chatBox']['enable']) {
    ?>
    <style>


        #mvvwo_chat_box {
            transform: translateY(50px) scale(0.9);
            transition: transform 300ms cubic-bezier(0.214, 0.61, 0.354, 1), opacity 300ms ease-in;
            position: fixed;
            right: 85px;
            bottom: 20px;
            width: 300px;
            font-size: 12px;
            line-height: 22px;
            font-family: 'Roboto';
            font-weight: 500;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
            opacity: 0;
            box-shadow: 1px 1px 100px 2px rgba(0, 0, 0, 0.22);
            border-radius: 4px;

            z-index: 9999;
            display: none;

            background: #fff;
            box-sizing: border-box;
        }

        #mvvwo_chat_box.mvvwo_animate {
            opacity: 1;
            transform: translateY(0px) scale(1);

        }

        #mvvwo_chat_box.mvvwo_show {
            display: block;

        }

        #mvvwo_chat_box.mvvwo_left {
            left: 80px;
        }

        .mvvwo_chat_header {

            font-size: 13px;
            font-family: 'Roboto';
            font-weight: 500;
            color: <?php echo $config['chatBox']['design']['headTxt']; ?>;;
            height: 60px;
            background: <?php echo $config['chatBox']['design']['headBg']; ?>;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            padding-top: 8px;
        }

        .mvvwo_chat_option {
            float: left;
            font-size: 15px;
            list-style: none;
            position: relative;
            height: 100%;
            width: 100%;

            letter-spacing: 0.5px;
            font-weight: 400
            box-sizing: border-box;
        }

        .mvvwo_chat_close {
            position: absolute;
            top: 3px;
            right: 9px;
            cursor: pointer;
            font-size: 18px;

        }

        .mvvwo_chat_option img {
            border-radius: 50%;
            width: 55px;
            float: left;
            margin: -30px 20px 10px 20px;
            border: 4px solid rgba(0, 0, 0, 0.21);
            box-sizing: border-box;
        }

        .mvvwo_chat_option .mvvwo_agent {
            font-size: 12px;
            font-weight: 300;
        }

        .mvvwo_chat_option .mvvwo_online {
            opacity: 0.3;
            font-size: 11px;
            font-weight: 300;
        }

        .mvvwo_chat_body {
            background: #fff;
            width: 100%;
            display: inline-block;
            text-align: center;
            overflow-y: auto;
            padding: 30px 20px;
            min-height: 180px;
            display: flex;
            /* flex-direction: column-reverse; */
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        .mvvwo_chat_body p {
            color: #424242;
        }

        .mvvwo_fab_field {
            width: 100%;
            display: inline-block;
            text-align: center;
            background: #fff;
            border-top: 1px solid #eee;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
            height: 55px;
            /* padding-bottom: 7px; */
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .mvvwo_fab_field a {
            display: inline-block;
            text-align: center;
        }

        #mvvwo_fab_send {
            float: right;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 40px;
            margin-right: 5px;
            box-sizing: border-box;
        }

        #mvvwo_fab_send svg {
            transform: rotate(20deg);
            margin: 0;
            fill: #6d6d6d;
            stroke: #ffffff;
            width: 30px;
            height: 30px;
            cursor: pointer;
            box-sizing: border-box;
        }

        #mvvwo_chat_box .mvvwo_chat_field.mvvwo_chat_message {
            height: 30px;
            resize: none;
            font-size: 13px;
            font-weight: 400;
            overflow: hidden;

            line-height: 20px;
        }

        #mvvwo_chat_box .mvvwo_chat_field {
            position: relative;
            margin: 5px 0 5px 0;
            width: 80%;
            font-family: 'Roboto';
            font-size: 12px;
            line-height: 30px;
            font-weight: 500;
            color: #4b4b4b;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
            border: none;
            outline: none;
            display: inline-block;
            background: #fff;
            box-shadow: none;
            min-height: 50px;
            box-sizing: border-box;
        }

        @media (max-width: 480px) {
            #mvvwo_chat_box.mvvwo_left {
                width: 100%;
                left: auto;
                right: auto;
                max-width: 320px;
                margin: 0 auto;
                left: 50%;
                margin-left: -160px;
            }
        }

        @media (max-width: 320px) {
            #mvvwo_chat_box.mvvwo_left {
                width: 100%;
                left: auto;
                right: auto;
                max-width: 320px;
                margin: 0 auto;

            }
        }
    </style>
    <?php
}
?>

