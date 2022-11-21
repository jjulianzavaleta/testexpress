<?php
$link = mvvwo_generate_whatsapp_link($config['mobile'], mvvwo_translate($config['floating']['message'], 'Floating Button Message'));
$position = isset($config['floating']['position']) ? $config['floating']['position'] : 'right';
?>
<div id="<?php echo MVVWO_TOKEN . '_floating_button'; ?>" class="<?php echo MVVWO_TOKEN . '_pos_' . $position; ?>">
    <?php
    if (isset($config['floating']['text']) && !empty($config['floating']['text']) && ($position !== 'left')) {
        echo '<div  class="' . MVVWO_TOKEN . '_txt">
        <a target="_blank" data-message="' . mvvwo_translate($config['floating']['message'], 'Floating Button Message') . '" href="#">
        ' . mvvwo_translate($config['floating']['text'], 'Floating Button Text') . '</a></div>';
    }
    ?>
    <a target="_blank"
       data-message="<?php echo mvvwo_translate($config['floating']['message'], 'Floating Button Message'); ?>"
       class="<?php echo MVVWO_TOKEN; ?>_btn" href="#">
        <svg enable-background="new 0 0 90 90" version="1.1" viewBox="0 0 90 90" xml:space="preserve"
             xmlns="http://www.w3.org/2000/svg">
	<path d="m90 43.841c0 24.213-19.779 43.841-44.182 43.841-7.747 0-15.025-1.98-21.357-5.455l-24.461 7.773 7.975-23.522c-4.023-6.606-6.34-14.354-6.34-22.637 0-24.213 19.781-43.841 44.183-43.841 24.405 0 44.182 19.628 44.182 43.841zm-44.182-36.859c-20.484 0-37.146 16.535-37.146 36.859 0 8.065 2.629 15.534 7.076 21.61l-4.641 13.689 14.275-4.537c5.865 3.851 12.891 6.097 20.437 6.097 20.481 0 37.146-16.533 37.146-36.857s-16.664-36.861-37.147-36.861zm22.311 46.956c-0.273-0.447-0.994-0.717-2.076-1.254-1.084-0.537-6.41-3.138-7.4-3.495-0.993-0.358-1.717-0.538-2.438 0.537-0.721 1.076-2.797 3.495-3.43 4.212-0.632 0.719-1.263 0.809-2.347 0.271-1.082-0.537-4.571-1.673-8.708-5.333-3.219-2.848-5.393-6.364-6.025-7.441-0.631-1.075-0.066-1.656 0.475-2.191 0.488-0.482 1.084-1.255 1.625-1.882 0.543-0.628 0.723-1.075 1.082-1.793 0.363-0.717 0.182-1.344-0.09-1.883-0.27-0.537-2.438-5.825-3.34-7.977-0.902-2.15-1.803-1.792-2.436-1.792-0.631 0-1.354-0.09-2.076-0.09s-1.896 0.269-2.889 1.344c-0.992 1.076-3.789 3.676-3.789 8.963 0 5.288 3.879 10.397 4.422 11.113 0.541 0.716 7.49 11.92 18.5 16.223 11.011 4.301 11.011 2.866 12.997 2.686 1.984-0.179 6.406-2.599 7.312-5.107 0.9-2.512 0.9-4.663 0.631-5.111z"/>
</svg>
    </a>
    <?php
    if (isset($config['floating']['text']) && !empty($config['floating']['text']) && ($position === 'left')) {
        echo '<div  class="' . MVVWO_TOKEN . '_txt"><a target="_blank" 
        data-message="' . mvvwo_translate($config['floating']['message'], 'Floating Button Message') . '"  href="#">' . mvvwo_translate($config['floating']['text'], 'Floating Button Text') . '</a></div>';
    }
    ?>
</div>
<?php
if (isset($config['chatBox']) && $config['chatBox']['enable']) {
    ?>
    <div id="mvvwo_chat_box" class="<?php echo ($position === 'left') ? 'mvvwo_left' : '' ?>">
        <div class="mvvwo_chat_header">
            <div class="mvvwo_chat_option">
                <div class="mvvwo_header_img">
                    <img src="">
                </div>
                <span id="mvvwo_chat_head">#</span> <br> <span class="mvvwo_agent">Agent</span> <span
                        class="mvvwo_online">(Online)</span>
            </div>
            <span class="mvvwo_chat_close">×</span>
        </div>
        <div class="mvvwo_chat_body " style="display: block;">
            <p><?php echo $config['chatBox']['text']; ?></p>
        </div>
        <div class="mvvwo_fab_field">
            <a id="mvvwo_fab_send" href="#" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-send">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </a>
            <textarea id="mvvwo_chatSend" name="mvvwo_chat_message" placeholder="<?php _e('Send a message','order-on-chat-for-woocommerce') ?>"
                      class="mvvwo_chat_field mvvwo_chat_message"><?php echo $config['chatBox']['message']; ?></textarea>
        </div>
    </div>
    <?php
}
?>

