"use strict";

var ScriptsBundle = ScriptsBundle || {};

$(function() {
    ScriptsBundle = {
        init: function() {
            ScriptsBundle.pageLoader();
            ScriptsBundle.initTooltip();
            ScriptsBundle.headerEvent();
            ScriptsBundle.themeDark();
            ScriptsBundle.toggleDropdown();
            ScriptsBundle.editor();
            ScriptsBundle.selectC();
            ScriptsBundle.settings();
            ScriptsBundle.setActiveTab();
        },

        pageLoader: function () {
            var $loader = $('#pb_loader');
            $loader.addClass('pb-loaded').delay(500).fadeOut();
        },

        /*!
         * Initialize data function
         *---------------------------------------------------*/
        initTooltip() {
            var $dataTooltip = $('[data-bs-toggle="tooltip"]');
            
            if ($dataTooltip.length) {
                $dataTooltip.tooltip();
            }
        },

        headerEvent: function () {
            var $hamburger = $('#pb_hamburger');
            var $icon = $('#pb_search_icon');
            var $body = $('body');
            var show = 'show';
            var hideSidebar = 'pb-hide-sidebar';

            $hamburger.on('click', function () {
                $body.toggleClass(hideSidebar);
            });
            
            $icon.on('click', function () {
                $(this).parent().toggleClass(show);
            });
        },

        themeDark: function() {
            var $dark = $('#pb_dark_mode');
            var dark = 'pb-theme-dark';

            if (localStorage.getItem('dark') === 'true') {
                $body.addClass(dark);
                $dark.attr('checked', true);
            }

            $dark.on('change', function(event) {
                if (event.target.checked) {
                    $body.addClass(dark);
                    localStorage.setItem('dark', true);
                } else {
                    $body.removeClass(dark);
                    localStorage.setItem('dark', false);
                }
            });
        },

        toggleDropdown: function () {
            var $sidebarLink = $('.nav-item-has-submenu > a');
            var $showMenu = $('.nav-item-submenu.show');
            var open = 'open';
            var show = 'show';

            $showMenu.slideDown(350);

            $sidebarLink.on('click', function (e) {
                e.stopPropagation();
                var $this = $(this);
                if ($this.next().hasClass(show)) {
                    $this.next().removeClass(show);
                    $this.parent().removeClass(open);
                    $this.next().slideUp(350);
                } else {
                    $this.parent().parent().find('.nav-item-submenu').removeClass(show).slideUp(350);
                    $this.parent().parent().find('.nav-item-has-submenu').removeClass(open);
                    $this.next().toggleClass(show);
                    $this.parent().toggleClass(open);
                    $this.next().slideToggle(350);
                }
            });
        },
        
        editor: function() {
            $("#editor").richText();
            $("#editor2").richText();
            $("#editor3").richText();
        },
        
        selectC: function() {
            $(".basic").select2({
                tags: true,
            });
            $(".basic2").select2({
                tags: true,
            });
            
            $(".tagging").select2({
                tags: true
            });
        },
        
        setActiveTab: function() {
            var current = 'current-tab';
            var activeTab = localStorage.getItem(current);
            var tabs = document.querySelectorAll('[data-bs-toggle="pill"]');

            var setTab = (tabId) => {
                var tab = document.querySelector('[data-bs-target="' + tabId + '"]');
                var content = document.querySelector(tabId);

                tab.classList.add('active');
                content.classList.add('show', 'active');

                localStorage.setItem(current, tabId);
            }

            if (activeTab) {
                setTab(activeTab);

            } else {
                var tabId = tabs[0].getAttribute('data-bs-target');                
                setTab(tabId);
            }

            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function (event) {
                    var tabId = event.target.getAttribute('data-bs-target');
                    setTab(tabId);
                });
            });
        },
        
        settings: function() {
           // Bannerbanner
            if ($("select[name='banner_ad_type']").val() === 'facebook') {
                $(".banner_size_fb").show();
                $(".banner_facebook_id").show();
                $(".banner_ad_id").hide();
                $(".banner_size").hide();
                $(".banner_startapp_id").hide();
                $(".banner_size_add").show();
                $(".p_ad_id").show();
                $(".p_app_id").hide();
                $(".p_game_id").hide();
                $(".banner_unity_id").hide();
                $(".banner_size_iron").hide();
                $(".p_app_key").hide();
                $(".banner_iron_id").hide();
            } else if ($("select[name='banner_ad_type']").val() === 'admob') {
                $(".banner_size_fb").hide();
                $(".banner_facebook_id").hide();
                $(".banner_ad_id").show();
                $(".banner_size").show();
                $(".banner_startapp_id").hide();
                $(".banner_size_add").show();
                $(".p_ad_id").show();
                $(".p_app_id").hide();
                $(".p_game_id").hide();
                $(".banner_unity_id").hide();
                $(".banner_size_iron").hide();
                $(".p_app_key").hide();
                $(".banner_iron_id").hide();
            } else if ($("select[name='banner_ad_type']").val() === 'startapp') {
                $(".banner_size_fb").hide();
                $(".banner_facebook_id").hide();
                $(".banner_ad_id").hide();
                $(".banner_size").hide();
                $(".banner_startapp_id").show();
                $(".banner_size_add").hide();
                $(".p_ad_id").hide();
                $(".p_app_id").show();
                $(".p_game_id").hide();
                $(".banner_unity_id").hide();
                $(".banner_size_iron").hide();
                $(".p_app_key").hide();
                $(".banner_iron_id").hide();
            } else if ($("select[name='banner_ad_type']").val() === 'unity') {
                $(".banner_size_fb").hide();
                $(".banner_facebook_id").hide();
                $(".banner_ad_id").hide();
                $(".banner_size").hide();
                $(".banner_startapp_id").hide();
                $(".banner_size_add").hide();
                $(".p_ad_id").hide();
                $(".p_app_id").hide();
                $(".p_app_id").hide();
                $(".p_game_id").show();
                $(".banner_unity_id").show();
                $(".banner_size_iron").hide();
                $(".p_app_key").hide();
                $(".banner_iron_id").hide();
            } else if ($("select[name='banner_ad_type']").val() === 'iron') {
                $(".banner_size_fb").hide();
                $(".banner_facebook_id").hide();
                $(".banner_ad_id").hide();
                $(".banner_size").hide();
                $(".banner_startapp_id").hide();
                $(".banner_size_add").show();
                $(".p_ad_id").hide();
                $(".p_app_id").hide();
                $(".p_app_id").hide();
                $(".p_game_id").hide();
                $(".banner_unity_id").hide();
                
                $(".banner_size_iron").show();
                $(".p_app_key").show();
                $(".banner_iron_id").show();
            }
            
            $("select[name='banner_ad_type']").change(function(e) {
                if ($(this).val() === 'facebook') {
                    $(".banner_size_fb").show();
                    $(".banner_facebook_id").show();
                    $(".banner_ad_id").hide();
                    $(".banner_size").hide();
                    $(".banner_startapp_id").hide();
                    $(".banner_size_add").show();
                    $(".p_ad_id").show();
                    $(".p_app_id").hide();
                    $(".p_game_id").hide();
                    $(".banner_unity_id").hide();
                    $(".banner_size_iron").hide();
                    $(".p_app_key").hide();
                    $(".banner_iron_id").hide();
                } else if ($(this).val() === 'admob') {
                    $(".banner_size_fb").hide();
                    $(".banner_facebook_id").hide();
                    $(".banner_ad_id").show();
                    $(".banner_size").show();
                    $(".banner_startapp_id").hide();
                    $(".banner_size_add").show();
                    $(".p_ad_id").show();
                    $(".p_app_id").hide();
                    $(".p_game_id").hide();
                    $(".banner_unity_id").hide();
                    $(".banner_size_iron").hide();
                    $(".p_app_key").hide();
                    $(".banner_iron_id").hide();
                } else if ($(this).val() === 'startapp') {
                    $(".banner_size_fb").hide();
                    $(".banner_facebook_id").hide();
                    $(".banner_ad_id").hide();
                    $(".banner_size").hide();
                    $(".banner_startapp_id").show();
                    $(".banner_size_add").hide();
                    $(".p_ad_id").hide();
                    $(".p_app_id").show();
                    $(".p_game_id").hide();
                    $(".banner_unity_id").hide();
                    $(".banner_size_iron").hide();
                    $(".p_app_key").hide();
                    $(".banner_iron_id").hide();
                } else if ($(this).val() === 'unity') {
                    $(".banner_size_fb").hide();
                    $(".banner_facebook_id").hide();
                    $(".banner_ad_id").hide();
                    $(".banner_size").hide();
                    $(".banner_startapp_id").hide();
                    $(".banner_size_add").hide();
                    $(".p_ad_id").hide();
                    $(".p_app_id").hide();
                    $(".p_app_id").hide();
                    $(".p_game_id").show();
                    $(".banner_unity_id").show();
                    $(".banner_size_iron").hide();
                    $(".p_app_key").hide();
                    $(".banner_iron_id").hide();
                } else if ($(this).val() === 'iron') {
                    $(".banner_size_fb").hide();
                    $(".banner_facebook_id").hide();
                    $(".banner_ad_id").hide();
                    $(".banner_size").hide();
                    $(".banner_startapp_id").hide();
                    $(".banner_size_add").show();
                    $(".p_ad_id").hide();
                    $(".p_app_id").hide();
                    $(".p_app_id").hide();
                    $(".p_game_id").hide();
                    $(".banner_unity_id").hide();
                    
                    $(".banner_size_iron").show();
                    $(".p_app_key").show();
                    $(".banner_iron_id").show();
                }
            });
            
            // Interstital
            if ($("select[name='interstital_ad_type']").val() === 'facebook') {
                $(".interstital_ad_id").hide();
                $(".interstital_facebook_id").show();
                $(".interstital_startapp_id").hide();
                $(".i_ad_id").show();
                $(".i_app_id").hide();
                $(".i_game_id").hide();
                $(".i_app_key").hide();
                $(".interstital_unity_id").hide();
                $(".interstital_iron_id").hide();
            }  else if ($("select[name='banner_ad_type']").val() === 'admob') {
                $(".interstital_facebook_id").hide();
                $(".interstital_ad_id").show();
                $(".interstital_startapp_id").hide();
                $(".i_ad_id").show();
                $(".i_app_id").hide();
                $(".i_game_id").hide();
                $(".i_app_key").hide();
                $(".interstital_unity_id").hide();
                $(".interstital_iron_id").hide();
            }  else if ($("select[name='banner_ad_type']").val() === 'startapp') {
                $(".interstital_facebook_id").hide();
                $(".interstital_ad_id").hide();
                $(".interstital_startapp_id").show();
                $(".i_ad_id").hide();
                $(".i_app_id").show();
                $(".i_game_id").hide();
                $(".i_app_key").hide();
                $(".interstital_unity_id").hide();
                $(".interstital_iron_id").hide();
            }  else if ($("select[name='banner_ad_type']").val() === 'unity') {
                $(".interstital_facebook_id").hide();
                $(".interstital_ad_id").hide();
                $(".interstital_startapp_id").hide();
                $(".i_ad_id").hide();
                $(".i_app_id").hide();
                $(".i_game_id").show();
                $(".i_app_key").hide();
                $(".interstital_unity_id").show();
                $(".interstital_iron_id").hide();
            }  else if ($("select[name='banner_ad_type']").val() === 'iron') {
                $(".interstital_facebook_id").hide();
                $(".interstital_ad_id").hide();
                $(".interstital_startapp_id").hide();
                $(".i_ad_id").hide();
                $(".i_app_id").hide();
                $(".i_game_id").hide();
                $(".i_app_key").show();
                $(".interstital_unity_id").hide();
                $(".interstital_iron_id").show();
            }
            
            $("select[name='interstital_ad_type']").change(function(e) {
                if ($(this).val() === 'facebook') {
                    $(".interstital_ad_id").hide();
                    $(".interstital_facebook_id").show();
                    $(".interstital_startapp_id").hide();
                    $(".i_ad_id").show();
                    $(".i_app_id").hide();
                    $(".i_game_id").hide();
                    $(".i_app_key").hide();
                    $(".interstital_unity_id").hide();
                    $(".interstital_iron_id").hide();
                }else if ($(this).val() === 'admob') {
                    $(".interstital_facebook_id").hide();
                    $(".interstital_ad_id").show();
                    $(".interstital_startapp_id").hide();
                    $(".i_ad_id").show();
                    $(".i_app_id").hide();
                    $(".i_game_id").hide();
                    $(".i_app_key").hide();
                    $(".interstital_unity_id").hide();
                    $(".interstital_iron_id").hide();
                }else if ($(this).val() === 'startapp') {
                    $(".interstital_facebook_id").hide();
                    $(".interstital_ad_id").hide();
                    $(".interstital_startapp_id").show();
                    $(".i_ad_id").hide();
                    $(".i_app_id").show();
                    $(".i_game_id").hide();
                    $(".i_app_key").hide();
                    $(".interstital_unity_id").hide();
                    $(".interstital_iron_id").hide();
                }else if ($(this).val() === 'unity') {
                    $(".interstital_facebook_id").hide();
                    $(".interstital_ad_id").hide();
                    $(".interstital_startapp_id").hide();
                    $(".i_ad_id").hide();
                    $(".i_app_id").hide();
                    $(".i_game_id").show();
                    $(".i_app_key").hide();
                    $(".interstital_unity_id").show();
                    $(".interstital_iron_id").hide();
                }else if ($(this).val() === 'iron') {
                    $(".interstital_facebook_id").hide();
                    $(".interstital_ad_id").hide();
                    $(".interstital_startapp_id").hide();
                    $(".i_ad_id").hide();
                    $(".i_app_id").hide();
                    $(".i_game_id").hide();
                    $(".i_app_key").show();
                    $(".interstital_unity_id").hide();
                    $(".interstital_iron_id").show();
                }
            });
            
            // Native
            if ($("select[name='native_ad_type']").val() === 'facebook') {
                $(".native_ad_id").hide();
                $(".native_facebook_id").show();
                $(".native_startapp_id").hide();
                $(".n_ad_id").show();
                $(".n_app_id").hide();
                $(".n_game_id").hide();
                $(".n_app_key").hide();
                $(".native_unity_id").hide();
                $(".native_iron_id").hide();
            }else if ($("select[name='native_ad_type']").val() === 'admob') {
                $(".native_facebook_id").hide();
                $(".native_ad_id").show();
                $(".native_startapp_id").hide();
                $(".n_ad_id").show();
                $(".n_app_id").hide();
                $(".n_game_id").hide();
                $(".n_app_key").hide();
                $(".native_unity_id").hide();
                $(".native_iron_id").hide();
            }else if ($("select[name='native_ad_type']").val() === 'startapp') {
                $(".native_facebook_id").hide();
                $(".native_ad_id").hide();
                $(".native_startapp_id").show();
                $(".n_ad_id").hide();
                $(".n_app_id").show();
                $(".n_game_id").hide();
                $(".n_app_key").hide();
                $(".native_unity_id").hide();
                $(".native_iron_id").hide();
            }else if ($("select[name='native_ad_type']").val() === 'unity') {
                $(".native_facebook_id").hide();
                $(".native_ad_id").hide();
                $(".native_startapp_id").hide();
                $(".n_ad_id").hide();
                $(".n_app_id").hide();
                $(".n_game_id").show();
                $(".n_app_key").hide();
                $(".native_unity_id").show();
                $(".native_iron_id").hide();
            }else if ($("select[name='native_ad_type']").val() === 'iron') {
                $(".native_facebook_id").hide();
                $(".native_ad_id").hide();
                $(".native_startapp_id").hide();
                $(".n_ad_id").hide();
                $(".n_app_id").hide();
                $(".n_game_id").hide();
                $(".n_app_key").show();
                $(".native_unity_id").hide();
                $(".native_iron_id").show();
            }
            
            $("select[name='native_ad_type']").change(function(e) {
                if ($(this).val() === 'facebook') {
                    $(".native_ad_id").hide();
                    $(".native_facebook_id").show();
                    $(".native_startapp_id").hide();
                    $(".n_ad_id").show();
                    $(".n_app_id").hide();
                    $(".n_app_key").hide();
                    $(".n_game_id").hide();
                    $(".native_unity_id").hide();
                    $(".native_iron_id").hide();
                }else if ($(this).val() === 'admob') {
                    $(".native_facebook_id").hide();
                    $(".native_ad_id").show();
                    $(".native_startapp_id").hide();
                    $(".n_ad_id").show();
                    $(".n_app_id").hide();
                    $(".n_app_key").hide();
                    $(".n_game_id").hide();
                    $(".native_unity_id").hide();
                    $(".native_iron_id").hide();
                }else if ($(this).val() === 'startapp') {
                     $(".native_facebook_id").hide();
                    $(".native_ad_id").hide();
                    $(".native_startapp_id").show();
                    $(".n_ad_id").hide();
                    $(".n_app_id").show();
                    $(".n_game_id").hide();
                    $(".n_app_key").hide();
                    $(".native_unity_id").hide();
                    $(".native_iron_id").hide();
                }else if ($(this).val() === 'unity') {
                     $(".native_facebook_id").hide();
                    $(".native_ad_id").hide();
                    $(".native_startapp_id").hide();
                    $(".n_ad_id").hide();
                    $(".n_app_id").hide();
                    $(".n_game_id").show();
                    $(".n_app_key").hide();
                    $(".native_unity_id").show();
                    $(".native_iron_id").hide();
                }else if ($(this).val() === 'iron') {
                    $(".native_facebook_id").hide();
                    $(".native_ad_id").hide();
                    $(".native_startapp_id").hide();
                    $(".n_ad_id").hide();
                    $(".n_app_id").hide();
                    $(".n_game_id").hide();
                    $(".n_app_key").show();
                    $(".native_unity_id").hide();
                    $(".native_iron_id").show();
                }
            });
        }
        
    };

    var $body = $('body');
    
    $(document).ready(ScriptsBundle.init);
});