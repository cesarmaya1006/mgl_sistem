/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */

/* eslint-disable camelcase */

(function ($) {
  'use strict'

  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1)
  }

  function createSkinBlock(colors, callback, noneSelected) {
    var $block = $('<select />', {
      class: noneSelected ? 'custom-select mb-3 border-0' : 'custom-select mb-3 text-light border-0 ' + colors[0].replace(/accent-|navbar-/, 'bg-')
    })

    if (noneSelected) {
      var $default = $('<option />', {
        text: 'None Selected'
      })
      if (callback) {
        $default.on('click', callback)
      }

      $block.append($default)
    }

    colors.forEach(function (color) {
      var $color = $('<option />', {
        class: (typeof color === 'object' ? color.join(' ') : color).replace('navbar-', 'bg-').replace('accent-', 'bg-'),
        text: capitalizeFirstLetter((typeof color === 'object' ? color.join(' ') : color).replace(/navbar-|accent-|bg-/, '').replace('-', ' '))
      })

      $block.append($color)

      $color.data('color', color)

      if (callback) {
        $color.on('click', callback)
      }
    })

    return $block
  }

  var $sidebar = $('.control-sidebar')
  var $container = $('<div />', {
    class: 'p-3 control-sidebar-content'
  })

  $sidebar.append($container)

  // Checkboxes

  $container.append(
    '<h5>Personanizar Sistema</h5><hr class="mb-2"/>'
  )

  var $dark_mode_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('dark-mode'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('dark-mode')
    } else {
      $('body').removeClass('dark-mode')
    }
  })
  $dark_mode_checkbox.attr("id","id_body_dark_mode")
  var $dark_mode_container = $('<div />', { class: 'mb-4' }).append($dark_mode_checkbox).append('<span>Modo Obscuro</span>')
  $container.append($dark_mode_container)

  $container.append('<h6>Opciones de encabezado</h6>')
  var $header_fixed_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('layout-navbar-fixed'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-navbar-fixed')
    } else {
      $('body').removeClass('layout-navbar-fixed')
    }
  })
  $header_fixed_checkbox.attr("id","id_encabezado_fijo").attr("bd_variable","encabezado_fijo")
  var $header_fixed_container = $('<div />', { class: 'mb-1' }).append($header_fixed_checkbox).append('<span>Fijo</span>')
  $container.append($header_fixed_container)

  var $dropdown_legacy_offset_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-header').hasClass('dropdown-legacy'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('dropdown-legacy')
    } else {
      $('.main-header').removeClass('dropdown-legacy')
    }
  })
  $dropdown_legacy_offset_checkbox.attr("bd_variable","dropdown_legacy")
  var $dropdown_legacy_offset_container = $('<div />', { class: 'mb-1' }).append($dropdown_legacy_offset_checkbox).append('<span>Desplazamiento heredado desplegable</span>')
  $container.append($dropdown_legacy_offset_container)

  var $no_border_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-header').hasClass('border-bottom-0'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('border-bottom-0')
    } else {
      $('.main-header').removeClass('border-bottom-0')
    }
  })
  $no_border_checkbox.attr("bd_variable","border_bottom")
  var $no_border_container = $('<div />', { class: 'mb-4' }).append($no_border_checkbox).append('<span>Sin bordes</span>')
  $container.append($no_border_container)

  $container.append('<h6>Opciones de la barra lateral</h6>')

  var $sidebar_collapsed_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('sidebar-collapse'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('sidebar-collapse')
      $(window).trigger('resize')
    } else {
      $('body').removeClass('sidebar-collapse')
      $(window).trigger('resize')
    }
  })
  $sidebar_collapsed_checkbox.attr("bd_variable","sidebar_collapse")
  var $sidebar_collapsed_container = $('<div />', { class: 'mb-1' }).append($sidebar_collapsed_checkbox).append('<span>Colapsado</span>')
  $container.append($sidebar_collapsed_container)

  $(document).on('collapsed.lte.pushmenu', '[data-widget="pushmenu"]', function () {
    $sidebar_collapsed_checkbox.prop('checked', true)
  })
  $(document).on('shown.lte.pushmenu', '[data-widget="pushmenu"]', function () {
    $sidebar_collapsed_checkbox.prop('checked', false)
  })

  var $sidebar_fixed_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('layout-fixed'),

    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-fixed')
      $(window).trigger('resize')
    } else {
      $('body').removeClass('layout-fixed')
      $(window).trigger('resize')
    }
  })
  $sidebar_fixed_checkbox.prop( "disabled", true )
  var $sidebar_fixed_container = $('<div />', { class: 'mb-1' }).append($sidebar_fixed_checkbox).append('<span>Fijo</span>')
  $container.append($sidebar_fixed_container)

  var $sidebar_mini_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('sidebar-mini'),
    class: 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('sidebar-mini')
    } else {
      $('body').removeClass('sidebar-mini')
    }
  })
  $sidebar_mini_checkbox.prop( "disabled", true )
  var $sidebar_mini_container = $('<div />', { class: 'mb-1' }).append($sidebar_mini_checkbox).append('<span>Mini barra lateral</span>')
  $container.append($sidebar_mini_container)

  var $sidebar_mini_md_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('sidebar-mini-md'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('sidebar-mini-md')
    } else {
      $('body').removeClass('sidebar-mini-md')
    }
  })
  $sidebar_mini_md_checkbox.attr("bd_variable","sidebar_mini_md_checkbox")
  var $sidebar_mini_md_container = $('<div />', { class: 'mb-1' }).append($sidebar_mini_md_checkbox).append('<span>Mini barra lateral MD</span>')
  $container.append($sidebar_mini_md_container)

  var $sidebar_mini_xs_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('sidebar-mini-xs'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('sidebar-mini-xs')
    } else {
      $('body').removeClass('sidebar-mini-xs')
    }
  })
  $sidebar_mini_xs_checkbox.attr("bd_variable","sidebar_mini_xs_checkbox")
  var $sidebar_mini_xs_container = $('<div />', { class: 'mb-1' }).append($sidebar_mini_xs_checkbox).append('<span>Mini barra lateral XS</span>')
  $container.append($sidebar_mini_xs_container)

  var $flat_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-flat'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-flat')
    } else {
      $('.nav-sidebar').removeClass('nav-flat')
    }
  })
  $flat_sidebar_checkbox.attr("bd_variable","flat_sidebar_checkbox")
  var $flat_sidebar_container = $('<div />', { class: 'mb-1' }).append($flat_sidebar_checkbox).append('<span>Estilo plano de navegación</span>')
  $container.append($flat_sidebar_container)

  var $legacy_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-legacy'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-legacy')
    } else {
      $('.nav-sidebar').removeClass('nav-legacy')
    }
  })
  $legacy_sidebar_checkbox.attr("bd_variable","legacy_sidebar_checkbox")
  var $legacy_sidebar_container = $('<div />', { class: 'mb-1' }).append($legacy_sidebar_checkbox).append('<span>Estilo heredado de navegación</span>')
  $container.append($legacy_sidebar_container)

  var $compact_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-compact'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-compact')
    } else {
      $('.nav-sidebar').removeClass('nav-compact')
    }
  })
  $compact_sidebar_checkbox.attr("bd_variable","compact_sidebar_checkbox")
  var $compact_sidebar_container = $('<div />', { class: 'mb-1' }).append($compact_sidebar_checkbox).append('<span>Navegación compacta</span>')
  $container.append($compact_sidebar_container)

  var $child_indent_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('nav-child-indent'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-child-indent')
    } else {
      $('.nav-sidebar').removeClass('nav-child-indent')
    }
  })
  $child_indent_sidebar_checkbox.attr("bd_variable","child_indent_sidebar_checkbox")
  var $child_indent_sidebar_container = $('<div />', { class: 'mb-1' }).append($child_indent_sidebar_checkbox).append('<span>Sangría secundaria de navegación</span>')
  $container.append($child_indent_sidebar_container)

  var $no_expand_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-sidebar').hasClass('sidebar-no-expand'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-sidebar').addClass('sidebar-no-expand')
    } else {
      $('.main-sidebar').removeClass('sidebar-no-expand')
    }
  })
  $no_expand_sidebar_checkbox.attr("bd_variable","no_expand_sidebar_checkbox")
  var $no_expand_sidebar_container = $('<div />', { class: 'mb-4' }).append($no_expand_sidebar_checkbox).append('<span>Deshabilitar la expansión automática de desplazamiento/enfoque</span>')
  $container.append($no_expand_sidebar_container)

  $container.append('<h6>Opciones de pie de página</h6>')
  var $footer_fixed_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('layout-footer-fixed'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-footer-fixed')
    } else {
      $('body').removeClass('layout-footer-fixed')
    }
  })
  $footer_fixed_checkbox.attr("bd_variable","footer_fixed_checkbox")
  var $footer_fixed_container = $('<div />', { class: 'mb-4' }).append($footer_fixed_checkbox).append('<span>Fijo</span>')
  $container.append($footer_fixed_container)

  $container.append('<h6>Opciones de texto pequeño</h6>')

  var $text_sm_body_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('body').hasClass('text-sm'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('text-sm')
    } else {
      $('body').removeClass('text-sm')
    }
  })
  $text_sm_body_checkbox.attr("bd_variable","text_sm_body_checkbox")
  var $text_sm_body_container = $('<div />', { class: 'mb-1' }).append($text_sm_body_checkbox).append('<span>Cuerpo</span>')
  $container.append($text_sm_body_container)

  var $text_sm_header_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-header').hasClass('text-sm'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('text-sm')
    } else {
      $('.main-header').removeClass('text-sm')
    }
  })
  $text_sm_header_checkbox.attr("bd_variable","text_sm_header_checkbox")
  var $text_sm_header_container = $('<div />', { class: 'mb-1' }).append($text_sm_header_checkbox).append('<span>Barra de navegación</span>')
  $container.append($text_sm_header_container)

  var $text_sm_brand_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.brand-link').hasClass('text-sm'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.brand-link').addClass('text-sm')
    } else {
      $('.brand-link').removeClass('text-sm')
    }
  })
  $text_sm_brand_checkbox.attr("bd_variable","text_sm_brand_checkbox")
  var $text_sm_brand_container = $('<div />', { class: 'mb-1' }).append($text_sm_brand_checkbox).append('<span>Marca</span>')
  $container.append($text_sm_brand_container)

  var $text_sm_sidebar_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.nav-sidebar').hasClass('text-sm'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('text-sm')
    } else {
      $('.nav-sidebar').removeClass('text-sm')
    }
  })
  $text_sm_sidebar_checkbox.attr("bd_variable","text_sm_sidebar_checkbox")
  var $text_sm_sidebar_container = $('<div />', { class: 'mb-1' }).append($text_sm_sidebar_checkbox).append('<span>Navegación de la barra lateral</span>')
  $container.append($text_sm_sidebar_container)

  var $text_sm_footer_checkbox = $('<input />', {
    type: 'checkbox',
    value: 1,
    checked: $('.main-footer').hasClass('text-sm'),
    class: 'mr-1 check_apariencia'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-footer').addClass('text-sm')
    } else {
      $('.main-footer').removeClass('text-sm')
    }
  })
  $text_sm_footer_checkbox.attr("bd_variable","text_sm_footer_checkbox")
  var $text_sm_footer_container = $('<div />', { class: 'mb-4' }).append($text_sm_footer_checkbox).append('<span>Pie de página</span>')
  $container.append($text_sm_footer_container)

  // Color Arrays

  var navbar_dark_skins = [
    'navbar-primary',
    'navbar-secondary',
    'navbar-info',
    'navbar-success',
    'navbar-danger',
    'navbar-indigo',
    'navbar-purple',
    'navbar-pink',
    'navbar-navy',
    'navbar-lightblue',
    'navbar-teal',
    'navbar-cyan',
    'navbar-dark',
    'navbar-gray-dark',
    'navbar-gray'
  ]

  var navbar_light_skins = [
    'navbar-light',
    'navbar-warning',
    'navbar-white',
    'navbar-orange'
  ]

  var sidebar_colors = [
    'bg-primary',
    'bg-warning',
    'bg-info',
    'bg-danger',
    'bg-success',
    'bg-indigo',
    'bg-lightblue',
    'bg-navy',
    'bg-light',
    'bg-purple'
  ]

  var accent_colors = [
    'accent-primary',
    'accent-warning',
    'accent-info',
    'accent-danger',
    'accent-success',
    'accent-indigo',
    'accent-lightblue',
    'accent-navy',
    'accent-purple',
    'accent-fuchsia',
    'accent-pink',
    'accent-maroon',
    'accent-orange',
    'accent-lime',
    'accent-teal',
    'accent-olive'
  ]

  var sidebar_skins = [
    'sidebar-dark-primary',
    'sidebar-dark-warning',
    'sidebar-dark-info',
    'sidebar-dark-danger',
    'sidebar-dark-success',
    'sidebar-dark-indigo',
    'sidebar-dark-lightblue',
    'sidebar-dark-navy',
    'sidebar-dark-purple',
    'sidebar-dark-fuchsia',
    'sidebar-dark-pink',
    'sidebar-dark-maroon',
    'sidebar-dark-orange',
    'sidebar-dark-lime',
    'sidebar-dark-teal',
    'sidebar-dark-olive',
    'sidebar-light-primary',
    'sidebar-light-warning',
    'sidebar-light-info',
    'sidebar-light-danger',
    'sidebar-light-success',
    'sidebar-light-indigo',
    'sidebar-light-lightblue',
    'sidebar-light-navy',
    'sidebar-light-purple',
    'sidebar-light-fuchsia',
    'sidebar-light-pink',
    'sidebar-light-maroon',
    'sidebar-light-orange',
    'sidebar-light-lime',
    'sidebar-light-teal',
    'sidebar-light-olive'
  ]

  // Navbar Variants

  $container.append('<h6>Fondo Barra Superior</h6>')

  var $navbar_variants = $('<div />', {class: 'd-flex'})
  var navbar_all_colors = sidebar_colors
  var $navbar_variants_colors = createSkinBlock(navbar_all_colors, function () {
    var color = $(this).data('color')
    var $main_header = $('.main-header')
    $main_header.removeClass('navbar-dark').removeClass('navbar-light')
    navbar_all_colors.forEach(function (color) {
        $main_header.removeClass(color)
    })

    $(this).parent().removeClass().addClass('custom-select mb-3 text-light border-0 ')

    if (navbar_dark_skins.indexOf(color) > -1) {
      $main_header.addClass('navbar-dark')
      $(this).parent().addClass(color).addClass('text-light')
    } else {
      $main_header.addClass('navbar-light')
      $(this).parent().addClass(color)
    }

    $main_header.addClass(color)
  })

  var active_navbar_color = null
  $('.main-header')[0].classList.forEach(function (className) {
    if (navbar_all_colors.indexOf(className) > -1 && active_navbar_color === null) {
      active_navbar_color = className.replace('navbar-', 'bg-')
    }
  })

  $navbar_variants_colors.find('option.' + active_navbar_color).prop('selected', true)
  $navbar_variants_colors.removeClass().addClass('custom-select mb-3 text-light border-0 fondo_barra_sup ').addClass(active_navbar_color).attr("id","fondo_barra_sup")

  $navbar_variants.append($navbar_variants_colors)

  $container.append($navbar_variants)

  // Sidebar Colors
    //--------------------------------------------------------------------------------------------------------
    $container.append('<h6>Fondo menú lateral</h6>')
    var $sidebar_variants = $('<div />', {
        class: 'd-flex'
      })

      var sidebar_all_colors = sidebar_colors
      var $sidebar_variants_colors = createSkinBlock(sidebar_all_colors, function () {
        var color = $(this).data('color')
        var $main_sidebar = $('.main-sidebar')
        $main_sidebar.removeClass('sidebar-dark').removeClass('sidebar-light')
        sidebar_all_colors.forEach(function (color) {
            $main_sidebar.removeClass(color)
        })

        $(this).parent().removeClass().addClass('custom-select mb-3 text-light border-0 ')

        if (sidebar_colors.indexOf(color) > -1) {
            $main_sidebar.addClass('sidebar-dark')
            $(this).parent().addClass(color).addClass('text-light')
        } else {
            $main_sidebar.addClass('sidebar-light')
            $(this).parent().addClass(color)
        }
        $main_sidebar.addClass(color)
    })

    var active_sidebar_color = null
    $('.main-sidebar')[0].classList.forEach(function (className) {
        if (sidebar_all_colors.indexOf(className) > -1 && active_sidebar_color === null) {
            active_sidebar_color = className
        }
    })
    //$sidebar_variants_colors.find(active_sidebar_color).prop('selected', true)

    $sidebar_variants_colors.removeClass().addClass('custom-select mb-3 text-light border-0 fondo_barra_lat mb-4 ').addClass(active_sidebar_color).attr("id","fondo_barra_lat")
    $sidebar_variants.append($sidebar_variants_colors)
    $container.append($sidebar_variants)
    $container.append('<br/>')
    $container.append('<br/>')
    $container.append('<br/>')
    $container.append('<hr/>')
    //--------------------------------------------------------------------------------------------------------




  /*$container.append('<h6>Fondo menú lateral</h6>')
  var $accent_variants = $('<div />', {
    class: 'd-flex'
  })
  $container.append($accent_variants)
  $container.append(createSkinBlock(accent_colors, function () {
    var color = $(this).data('color')
    var accent_class = color
    var $body = $('body')
    accent_colors.forEach(function (skin) {
      $body.removeClass(skin)
    })

    $body.addClass(accent_class)
  }, true))

  var active_accent_color = null
  $('body')[0].classList.forEach(function (className) {
    if (accent_colors.indexOf(className) > -1 && active_accent_color === null) {
      active_accent_color = className.replace('navbar-', 'bg-')
    }
  })*/

  //$accent_variants.find('option.' + active_accent_color).prop('selected', true)
  //$accent_variants.removeClass().addClass('custom-select mb-3 text-light border-0 fondo_barra_lat ').addClass(active_accent_color).attr("id","fondo_barra_lat")

  /*$container.append('<h6>Variantes de la barra lateral oscura</h6>')
  var $sidebar_variants_dark = $('<div />', {
    class: 'd-flex'
  })
  $container.append($sidebar_variants_dark)
  var $sidebar_dark_variants = createSkinBlock(sidebar_colors, function () {
    var color = $(this).data('color')
    var sidebar_class = 'sidebar-dark-' + color.replace('bg-', '')
    var $sidebar = $('.main-sidebar')
    sidebar_skins.forEach(function (skin) {
      $sidebar.removeClass(skin)
      $sidebar_light_variants.removeClass(skin.replace('sidebar-dark-', 'bg-')).removeClass('text-light')
    })

    $(this).parent().removeClass().addClass('custom-select mb-3 text-light border-0').addClass(color)

    $sidebar_light_variants.find('option').prop('selected', false)
    $sidebar.addClass(sidebar_class)
    $('.sidebar').removeClass('os-theme-dark').addClass('os-theme-light')
  }, true)
  $container.append($sidebar_dark_variants)

  var active_sidebar_dark_color = null
  $('.main-sidebar')[0].classList.forEach(function (className) {
    var color = className.replace('sidebar-dark-', 'bg-')
    if (sidebar_colors.indexOf(color) > -1 && active_sidebar_dark_color === null) {
      active_sidebar_dark_color = color
    }
  })

  $sidebar_dark_variants.find('option.' + active_sidebar_dark_color).prop('selected', true)
  $sidebar_dark_variants.removeClass().addClass('custom-select mb-3 text-light border-0 ').addClass(active_sidebar_dark_color)
*/
  /*$container.append('<h6>Variantes de barra lateral ligera</h6>')
  var $sidebar_variants_light = $('<div />', {
    class: 'd-flex'
  })
  $container.append($sidebar_variants_light)
  var $sidebar_light_variants = createSkinBlock(sidebar_colors, function () {
    var color = $(this).data('color')
    var sidebar_class = 'sidebar-light-' + color.replace('bg-', '')
    var $sidebar = $('.main-sidebar')
    sidebar_skins.forEach(function (skin) {
      $sidebar.removeClass(skin)
      $sidebar_dark_variants.removeClass(skin.replace('sidebar-light-', 'bg-')).removeClass('text-light')
    })

    $(this).parent().removeClass().addClass('custom-select mb-3 text-light border-0').addClass(color)

    $sidebar_dark_variants.find('option').prop('selected', false)
    $sidebar.addClass(sidebar_class)
    $('.sidebar').removeClass('os-theme-light').addClass('os-theme-dark')
  }, true)
  $container.append($sidebar_light_variants)

  var active_sidebar_light_color = null
  $('.main-sidebar')[0].classList.forEach(function (className) {
    var color = className.replace('sidebar-light-', 'bg-')
    if (sidebar_colors.indexOf(color) > -1 && active_sidebar_light_color === null) {
      active_sidebar_light_color = color
    }
  })

  if (active_sidebar_light_color !== null) {
    $sidebar_light_variants.find('option.' + active_sidebar_light_color).prop('selected', true)
    $sidebar_light_variants.removeClass().addClass('custom-select mb-3 text-light border-0 ').addClass(active_sidebar_light_color)
  }

  var logo_skins = navbar_all_colors
  $container.append('<h6>Variantes del logotipo de la marca</h6>')
  var $logo_variants = $('<div />', {
    class: 'd-flex'
  })
  $container.append($logo_variants)
  var $clear_btn = $('<a />', {
    href: '#'
  }).text('clear').on('click', function (e) {
    e.preventDefault()
    var $logo = $('.brand-link')
    logo_skins.forEach(function (skin) {
      $logo.removeClass(skin)
    })
  })

  var $brand_variants = createSkinBlock(logo_skins, function () {
    var color = $(this).data('color')
    var $logo = $('.brand-link')

    if (color === 'navbar-light' || color === 'navbar-white') {
      $logo.addClass('text-black')
    } else {
      $logo.removeClass('text-black')
    }

    logo_skins.forEach(function (skin) {
      $logo.removeClass(skin)
    })

    if (color) {
      $(this).parent().removeClass().addClass('custom-select mb-3 border-0').addClass(color).addClass(color !== 'navbar-light' && color !== 'navbar-white' ? 'text-light' : '')
    } else {
      $(this).parent().removeClass().addClass('custom-select mb-3 border-0')
    }

    $logo.addClass(color)
  }, true).append($clear_btn)
  $container.append($brand_variants)

  var active_brand_color = null
  $('.brand-link')[0].classList.forEach(function (className) {
    if (logo_skins.indexOf(className) > -1 && active_brand_color === null) {
      active_brand_color = className.replace('navbar-', 'bg-')
    }
  })

  if (active_brand_color) {
    $brand_variants.find('option.' + active_brand_color).prop('selected', true)
    $brand_variants.removeClass().addClass('custom-select mb-3 text-light border-0 ').addClass(active_brand_color)
  }*/
})(jQuery)
