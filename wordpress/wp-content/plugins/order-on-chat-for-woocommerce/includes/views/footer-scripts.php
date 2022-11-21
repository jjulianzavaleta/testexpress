<script>
    var mvv_whatsAppLink = function (mobile, message) {
        mobile = mobile.replace(/[^0-9]/g, '');
        return 'https://api.whatsapp.com/send?phone=' + mobile + '&text=' + encodeURI(message);
    }

    var mvvwo_replace = function (txt, ele) {
        if (ele.getAttribute('data-replacesUpdated')) {
            var replaces = JSON.parse(ele.getAttribute('data-replacesUpdated'));
        } else {
            var replaces = JSON.parse(ele.getAttribute('data-replaces'));
        }
        if (replaces) {
            Object.keys(replaces).forEach(function (e) {
                var re = new RegExp(e, 'g')
                txt = txt.replace(re, replaces[e]);

            })
        }

        txt = txt.replace(/{PAGE_URL}/, window.location.href);

        return txt;
    }

    function mvvwo_init() {

        var mvvwo_ele = document.getElementById('mvvwo_floating_button');
        <?php
        $numbers = [];

        if (isset($config['mobile']) && !empty($config['mobile'])) {
            $numbers[] = [
                'avatar' => (isset($config['temp']['avatar']) && !empty($config['temp']['avatar'])) ? $config['temp']['avatar'] : mvvwo_getTempProfil(),
                'number' => sanitize_text_field($config['mobile']),
                'name' => isset($config['temp']['name']) && $config['temp']['name'] ? ($config['temp']['name']) : false,
                'active' => true,
                'availDays' => false,
                'availTime' => false,
            ];
        }
        if (isset($config['numbers']) && !empty($config['numbers'])) {
            $numbers = array_merge($numbers, $config['numbers']);
            $numbers = array_map(function ($item) {
                if (empty($item['avatar'])) {
                    $item['avatar'] = mvvwo_getTempProfil();
                }
                return $item;
            }, $numbers);
        }
        $numbers = array_filter($numbers, function ($n) {
            return $n['active'];
        });
        echo 'var mvvwo_numbers=' . json_encode(array_values($numbers)) . ';';
        ?>
        var mvvwoIsOnline = true;
        var mvvwo_numbersAvailable = mvvwo_numbers.filter(function (e) {
            if (e.availDays == false && e.availTime == false) {
                return true;
            }
            var day = new Date().getDay();
            if (e.availDays != false && e.availDays.indexOf(day) < 0) {
                return false;
            }
            var mnts = new Date().getHours() * 60 + new Date().getMinutes() * 1;
            if (e.availTime != false && (mnts > e.availTime[1] || mnts < e.availTime[0])) {
                return false;
            }
            return true;

        })
        if (mvvwo_numbersAvailable.length == 0) {
            mvvwo_numbersAvailable = mvvwo_numbers[0];
            mvvwoIsOnline = false;

        } else {
            mvvwo_numbersAvailable = mvvwo_numbersAvailable[Math.floor(Math.random() * mvvwo_numbersAvailable.length)];
            /* select an number randomly*/
        }
        <?php
        if (isset($config['chatBox']) && $config['chatBox']['enable'] && $config['floating']['enable']) {
        ?>
        if (mvvwo_ele) {
            var chatBox = document.getElementById('mvvwo_chat_box');
            mvvwo_ele.querySelectorAll('a').forEach(function (link) {
                link.addEventListener("click", function (event) {
                    if (chatBox.className.indexOf('mvvwo_show') >= 0) {
                        chatBox.className = chatBox.className.replace('mvvwo_animate', '');
                        setTimeout(function () {
                            chatBox.className = chatBox.className.replace('mvvwo_show', '');
                        }, 300)

                    } else {
                        chatBox.className = chatBox.className + ' mvvwo_show';
                        setTimeout(function () {
                            chatBox.className = chatBox.className + ' mvvwo_animate';
                        }, 0)
                    }
                    document.getElementById('mvvwo_chat_head').innerText = mvvwo_numbersAvailable.name;
                    if (mvvwoIsOnline === false) {
                        document.querySelector('.mvvwo_online').innerText = '(Offline)';
                    }
                    document.querySelector('.mvvwo_chat_header img').src = mvvwo_numbersAvailable.avatar;
                    event.preventDefault();
                });
            })

            document.getElementById('mvvwo_fab_send').addEventListener("click", function (event) {
                var mvv_message = document.getElementById('mvvwo_chatSend').value;
                this.setAttribute('href', mvv_whatsAppLink(mvvwo_numbersAvailable.number, mvv_message));

            })
            document.querySelector('.mvvwo_chat_close').addEventListener("click", function (event) {
                chatBox.className = chatBox.className.replace('mvvwo_show', '');
            })
        }




        <?php
        }else if( $config['floating']['enable']) {
        ?>
        if (mvvwo_ele) {
            mvvwo_ele.querySelectorAll('a').forEach(function (link) {
                var mvv_message = link.getAttribute('data-message');
                mvv_message = mvv_message.replace(/{PAGE_URL}/, window.location.href);
                link.setAttribute('href', mvv_whatsAppLink(mvvwo_numbersAvailable.number, mvv_message));

            });
        }
        <?php
        }
        if ($config['product']['enable']) {
        ?>
        document.querySelectorAll('.mvvwo_cart_button a').forEach(function (link) {
            link.addEventListener("click", function (event) {

                var mvv_message = link.getAttribute('data-message');
                mvv_message = mvvwo_replace(mvv_message, link);

                link.setAttribute('href', mvv_whatsAppLink(mvvwo_numbersAvailable.number, mvv_message));

            })
            // var mvv_message = link.getAttribute('data-message');
            //  link.setAttribute('href', mvv_whatsAppLink(mvvwo_numbersAvailable.number, mvv_message));
        })
        <?php
        }

        ?>
        document.querySelectorAll('.mvvwo_whatsbutton a').forEach(function (link) {
            var mvv_message = link.getAttribute('data-message');
            mvv_message = mvv_message.replace(/{PAGE_URL}/, window.location.href);
            link.setAttribute('href', mvv_whatsAppLink(mvvwo_numbersAvailable.number, mvv_message));
        })
        document.querySelectorAll('.mvvwo_cart_page_button a').forEach(function (link) {
            var mvv_message = link.getAttribute('data-message');
            link.setAttribute('href', mvv_whatsAppLink(mvvwo_numbersAvailable.number, mvv_message));
        })


        if (mvvwo_ele) {
            setTimeout(function () {
                mvvwo_ele.className = mvvwo_ele.className + ' mvvwo_show';
            }, <?php echo(isset($config['floating']['delay']) ? $config['floating']['delay'] : 1000); ?>)
        }

    }

    if (window.jQuery) {
        jQuery(document).ready(function ($) {
            $(document).on('reset_data', ".variations_form", function (event, variation) {
                $(".mvvwo_cart_button a", $(event.currentTarget)).data("replacesUpdated", false);
            })
            $(document).on('show_variation', ".variations_form", function (event, variation) {

                var varName = [];
                if (variation.attributes) {
                    var varName = Object.keys(variation.attributes).filter(function (e) {
                        return variation.attributes[e] != null && variation.attributes[e] != ''
                    }).map(function (e) {
                        return $("select[name=" + e + "] option[value=" + variation.attributes[e] + "]", $(event.currentTarget)).text();
                    })

                }
                var replaces = $(".mvvwo_cart_button a", $(event.currentTarget)).data("replaces");
                var replacesUpdated = Object.assign({}, replaces);
                replacesUpdated['{PRODUCT_NAME}'] = replaces['{PRODUCT_NAME}'] + ' ' + varName.join(',')
                if (variation.display_price) {
                    replacesUpdated['{PRODUCT_PRICE}'] = replaces['{PRODUCT_PRICE}'].replace(/([0-9,.]+)/, variation.display_price)
                }
                $(".mvvwo_cart_button a", $(event.currentTarget)).attr("data-replacesUpdated", JSON.stringify(replacesUpdated));
            })
        });
    }
    mvvwo_init();
</script>


