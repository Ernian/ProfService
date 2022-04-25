jQuery(document).ready(function ($) {

    // jQuery sticky Menu

    $(".mainmenu-area").sticky({ topSpacing: 0 });


    $('.product-carousel').owlCarousel({
        loop: true,
        nav: true,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 4,
            }
        }
    });

    $('.related-products-carousel').owlCarousel({
        loop: true,
        nav: true,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    $('.brand-list').owlCarousel({
        loop: true,
        nav: true,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 3,
            }
        }
    });


    // Bootstrap Mobile Menu fix
    $(".navbar-nav li a").click(function () {
        $(".navbar-collapse").removeClass('in');
    });

    // jQuery Scroll effect
    // $('.navbar-nav li a, .scroll-to-up').bind('click', function (event) {
    //     var $anchor = $(this);
    //     var headerH = $('.header-area').outerHeight();
    //     $('html, body').stop().animate({
    //         scrollTop: $($anchor.attr('href')).offset().top - headerH + "px"
    //     }, 1200, 'easeInOutExpo');

    //     event.preventDefault();
    // });

    // Bootstrap ScrollPSY
    $('body').scrollspy({
        target: '.navbar-collapse',
        offset: 95
    })

    $('.add-to-cart').on('click', function (event) {
        event.preventDefault()
        const id = $(this).data('id')
        const qty = $('#inputQty').val()
        const url = qty ? `/cart/add?id=${id}&qty=${qty}` : `/cart/add?id=${id}`
        $.ajax({
            // url: url,
            url,
            type: 'GET',
            success: function (response) {
                if (!response) {
                    console.log('Empty answer')
                    return
                }
                renderCart(JSON.parse(response), false)
            },
            error: function (error) {
                console.log(error)
            }
        })
    })
    $('.clear-cart').on('click', function (event) {
        event.preventDefault()
        $.ajax({
            url: '/cart/clear-cart',
            type: 'GET',
            success: function (response) {
                renderCart(response, true)
            },
            error: function (error) {
                console.log(error)
            }
        })
    })

    function renderCart(html, clearCart) {
        const totalPrice = document.querySelector('#total-price')
        const totalCount = document.querySelector('#total-count')

        if (clearCart) {
            console.log('clearCart')
            if (totalPrice && totalCount) {
                console.log('clearCart if (totalPrice && totalCount)')
                totalCount.remove()
                totalPrice.remove()
            }
            document.querySelectorAll('.cart-container').
                forEach(cartContainer => cartContainer.innerHTML = '<h5>Корзина пуста</h5>')
            return
        }

        if (totalPrice && totalCount) {
            console.log('обновление данных')
            totalCount.innerHTML = html[0]
            totalPrice.innerHTML = html[1]
            document.querySelectorAll('.cart-container').
                forEach(cartContainer => cartContainer.innerHTML = html[2])
        } else {
            console.log('создание тэгов')
            const spanCount = document.createElement('span')
            const spanPrice = document.createElement('span')
            spanCount.classList.add('product-count')
            spanPrice.classList.add('cart-amount')
            spanCount.setAttribute('id', 'total-count')
            spanPrice.setAttribute('id', 'total-price')
            spanCount.innerHTML = html[0]
            spanPrice.innerHTML = html[1]
            document.querySelector('.cart-link').append(spanPrice)
            document.querySelector('.cart-link').append(spanCount)
            document.querySelector('.cart-container').innerHTML = html[2]
        }
    }

    $('.cart-container').on('click', function (event) {
        if (event.target.classList.contains('btn-product-qty')) {
            const action = event.target.dataset.action
            const id = event.target.dataset.id
            let qty
            if (action === '+') {
                qty = 1
            } else if (action === '-') {
                qty = -1
            }
            $.ajax({
                url: `/cart/add?id=${id}&qty=${qty}`,
                type: 'GET',
                success: function (response) {
                    if (!response) {
                        console.log('Empty answer')
                        return
                    }
                    if (response == 'empty cart') {
                        console.log('del product empty cart')
                        renderCart(response, true)
                        return
                    }
                    renderCart(JSON.parse(response), false)
                },
                error: function (error) {
                    console.log(error)
                }
            })
        }
        if (event.target.classList.contains('del-product')) {
            const id = event.target.dataset.id
            $.ajax({
                url: `/cart/delete-product?id=${id}`,
                type: 'GET',
                success: function (response) {
                    if (!response) {
                        console.log('Empty answer')
                        return
                    }
                    if (response == 'empty cart') {
                        console.log('del product empty cart')
                        renderCart(response, true)
                        return
                    }
                    renderCart(JSON.parse(response), false)
                    console.log('del product')
                },
                error: function (error) {
                    console.log(error)
                }
            })
        }
    })

    let str = ''
    const reference = 'dj'
    document.addEventListener('keypress', event => {
        str += event.key
        console.log(str)
        if (reference.indexOf(str) !== 0) {
            str = ''
            return
        }
        if (str === reference) {
            console.clear()
            str = ''
            console.log('worked!')
            $.ajax({
                url: '/site/login',
                type: 'POST',
                success: function (response) {
                    document.querySelector('#myAdmin .admin-form').innerHTML = JSON.parse(response)
                },
                error: function (error) {
                    console.log(error)
                }
            })
            $('#myAdmin').modal('show')
        }
    })



});
