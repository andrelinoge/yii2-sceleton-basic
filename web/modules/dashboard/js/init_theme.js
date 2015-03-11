	$(function() {
	    bs_custom.accordion_active_class();
	    bs_custom.dropdown_click();
	    bs_custom.tooltips_init();
	    bs_custom.popover_init();
	    main_menu.init();
	    FastClick.attach(document.body)
	});

	function is_touch_device() {
	    return !!("ontouchstart" in window)
	}

	function isHighDensity() {
	    return window.matchMedia && (window.matchMedia("only screen and (min-resolution: 124dpi), only screen and (min-resolution: 1.3dppx), only screen and (min-resolution: 48.8dpcm)").matches || window.matchMedia("only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 2.6/2), only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (min-device-pixel-ratio: 1.3)").matches) || window.devicePixelRatio && 1.3 < window.devicePixelRatio
	}

	(function(a) {
	    var b = a.event,
	        c, d;
	    c = b.special.debouncedresize = {
	        setup: function() {
	            a(this).on("resize", c.handler)
	        },
	        teardown: function() {
	            a(this).off("resize", c.handler)
	        },
	        handler: function(a, f) {
	            var g = this,
	                k = arguments,
	                h = function() {
	                    a.type = "debouncedresize";
	                    b.dispatch.apply(g, k)
	                };
	            d && clearTimeout(d);
	            f ? h() : d = setTimeout(h, c.threshold)
	        },
	        threshold: 150
	    }
	})(jQuery);

	(function(a) {
	    var b = a.event,
	        c, d = {
	            _: 0
	        }, e = 0,
	        f, g;
	    c = b.special.throttledresize = {
	        setup: function() {
	            a(this).on("resize", c.handler)
	        },
	        teardown: function() {
	            a(this).off("resize", c.handler)
	        },
	        handler: function(k, h) {
	            var l = this,
	                m = arguments;
	            f = !0;
	            g || (setInterval(function() {
	                e++;
	                if (e > c.threshold && f || h) k.type = "throttledresize", b.dispatch.apply(l, m), f = !1, e = 0;
	                9 < e && (a(d).stop(), g = !1, e = 0)
	            }, 30), g = !0)
	        },
	        threshold: 0
	    }
	})(jQuery);

	main_menu = {
	    init: function() {
	        $("#main_menu ul > li").each(function() {
	            $(this).children("ul").length && $(this).addClass("has_submenu")
	        });
	        $(document).off("click", ".side_menu_expanded #main_menu .has_submenu > a").on("click", ".side_menu_expanded #main_menu .has_submenu > a", function() {
	            if ($(this).parent(".has_submenu").hasClass("first_level")) {
	                var a = $(this).parent(".has_submenu");
	                a.hasClass("section_active") ? a.removeClass("section_active").children("ul").slideUp("200") : (a.siblings().removeClass("section_active").children("ul").slideUp("200"),
	                    a.addClass("section_active").children("ul").slideDown("200"))
	            } else a = $(this).parent(".has_submenu"), a.hasClass("submenu_active") ? a.removeClass("submenu_active").children("ul").slideUp("200") : (a.siblings().removeClass("submenu_active").children("ul").slideUp("200"), a.addClass("submenu_active").children("ul").slideDown("200"))
	        });
	        $("#main_menu .has_submenu").hasClass("section_active") ? $("#main_menu .has_submenu.section_active").children("ul").show() : $("#main_menu .has_submenu .act_nav").closest(".has_submenu").children("a").click();
	        $(".menu_toggle").click(function() {
	            $("body").hasClass("side_menu_expanded") ? main_menu.menu_collapse() : $("body").hasClass("side_menu_collapsed") && main_menu.menu_expand();
	            $(window).off("debouncedresize").trigger("resize").on("debouncedresize")
	        });
	        $("body").hasClass("side_menu_expanded") && 992 >= $(window).width() && main_menu.menu_collapse();
	        $("body").hasClass("side_menu_expanded") && main_menu.menu_scrollbar_create()
	    },

	    menu_expand: function() {
	        $("body").addClass("side_menu_expanded").removeClass("side_menu_collapsed");
	        $(".menu_toggle").find(".toggle_left").show();
	        $(".menu_toggle").find(".toggle_right").hide();
	        main_menu.menu_scrollbar_create()
	    },

	    menu_collapse: function() {
	        $("body").removeClass("side_menu_expanded").addClass("side_menu_collapsed");
	        $(".menu_toggle").find(".toggle_left").hide();
	        $(".menu_toggle").find(".toggle_right").show();
	        main_menu.menu_scrollbar_destroy()
	    },

	    menu_cookie: function() {
	        $(".menu_toggle").on("click", function() {
	            $("body").hasClass("side_menu_expanded") ? $.cookie("side_menu", "1") : $("body").hasClass("side_menu_collapsed") &&
	                $.cookie("side_menu", "0")
	        });
	        var a = $.cookie("side_menu");
	        void 0 != a && ("1" == a ? main_menu.menu_expand() : "0" == a && main_menu.menu_collapse())
	    },

	    position_top: function() {
	        $("body").removeClass("side_menu_active side_menu_expanded side_menu_collapsed").addClass("top_menu_active")
	    },

	    position_side: function() {
	        $("body").removeClass("top_menu_active").addClass("side_menu_active");
	        main_menu.menu_collapse()
	    },
	    menu_scrollbar_create: function() {
	        $("#main_menu .menu_wrapper").mCustomScrollbar({
	            theme: "minimal-dark",
	            scrollbarPosition: "outside"
	        })
	    },

	    menu_scrollbar_destroy: function() {
	        $("#main_menu .menu_wrapper").mCustomScrollbar("destroy")
	    }
	};

	bs_custom = {
	    accordion_active_class: function() {
	        $(".panel-collapse").length && ($(".panel-collapse.in").closest(".panel").addClass("panel-active"), $(".panel-collapse").on("hide.bs.collapse", function() {
	            $(this).closest(".panel").removeClass("panel-active")
	        }).on("show.bs.collapse", function() {
	            $(this).closest(".panel").addClass("panel-active")
	        }))
	    },
	    dropdown_click: function() {
	        $(".header_notifications .dropdown-menu").length && $(".header_notifications .dropdown-menu").click(function(a) {
	            a.stopPropagation()
	        })
	    },
	    tooltips_init: function() {
	        $(".bs_ttip").tooltip({
	            container: "body"
	        })
	    },
	    popover_init: function() {
	        $(".bs_popup").popover({
	            container: "body"
	        })
	    }
	};
