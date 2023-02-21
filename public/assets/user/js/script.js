
/*===== LOADER =====*/
const loader = $('.loader-container')

let loaderInterval = setInterval(() => {
    loader.children().addClass('done')
}, 1250);

$('.swal2-container').hide()
window.setTimeout(() => {
    loader.hide();
    $('.swal2-container').show()
    clearInterval(loaderInterval);
}, 1750);

$('.form-password-toggle .input-group-text').click( function(a) {
    a.preventDefault();
    var e = $(this),
        s = e.closest(".form-password-toggle"),
        o = s.find("input"),
        n = e.find("ion-icon");
        "text" === o.attr("type") ? (o.attr("type", "password"), n.attr("name", "eye-outline")) : (o.attr("type", "text"), n.attr("name", "eye-off-outline"))
})

var inputContainer = document.querySelector(".auth-input-wrapper");
inputContainer.onkeyup = function (e) {
    var n = e.srcElement,
        a = parseInt(n.attributes.maxlength.value, 10),
        t = n.value.length;
    if (8 === e.keyCode) {
        if (0 === t)
            for (var r = n;
                (r = r.previousElementSibling) && null != r;)
                if ("input" == r.tagName.toLowerCase()) {
                    r.focus();
                    break
                }
    } else if (t >= a)
        for (r = n;
            (r = r.nextElementSibling) && null != r;)
            if ("input" == r.tagName.toLowerCase()) {
                r.focus();
                break
            }
};
const numeralMask = document.querySelectorAll(".numeral-mask");
numeralMask.length && numeralMask.forEach((e => {
    new Cleave(e, {
        numeral: !0
    })
}));

function getOffCanvas(link) {
	$.ajax({
		type: "GET",
		url: link,
		dataType: "html",
		beforeSend: function () {
			$("#myCanvas").html(
				'<div class="offcanvas-body"><div class="d-flex justify-content-center"><div class="spinner-border text-secondary" role="status"><span class="visually-hidden">Loading...</span></div></div></div>'
			)
		},
		success: function (result) {
			setTimeout(function () {
				$("#myCanvas").html(result)
			}, 1000)
		},
		error: function () {
			$("#myCanvas").html(
				'<div class="offcanvas-body">Failed to get contents....</div>'
			)
		},
	})
	$("#myCanvas").offcanvas("show")
}

function getModal(link) {
	$.ajax({
		type: "GET",
		url: link,
		dataType: "html",
		beforeSend: function () {
			$("#myModal-content").html(
				'<div class="modal-body"><div class="d-flex justify-content-center"><div class="spinner-border text-secondary" role="status"><span class="visually-hidden">Loading...</span></div></div></div>'
			)
		},
		success: function (result) {
			setTimeout(function () {
				$("#myModal-content").html(result)
			}, 1000)
		},
		error: function () {
			$("#myModal-content").html(
				'<div class="modal-body">Failed to get contents....</div>'
			)
		},
	})
	$("#myModal").modal("show")
}

function postModal(link, form) {
	$.ajax({
		type: "POST",
		url: link,
		data: $(form).serialize(),
		dataType: "html",
		beforeSend: function () {
			$("#myModal-content").html(
				'<div class="modal-body"><div class="d-flex justify-content-center"><div class="spinner-border text-secondary" role="status"><span class="visually-hidden">Loading...</span></div></div></div>'
			)
		},
		success: function (result) {
			setTimeout(function () {
				$("#myModal-content").html(result)
			}, 1000)
		},
		error: function () {
			$("#myModal-content").html(
				'<div class="modal-body">Failed to get contents....</div>'
			)
		},
	})
	$("#myModal").modal("show")
}

function addMenu(form) {
    Swal.fire({
        title: 'Apakah Anda Ingin Menambahkan Menu Ke Database?',
        showDenyButton: true,
        icon: 'question',
        confirmButtonText: 'Ya, Tambah Menu',
        denyButtonText: 'Batalkan',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: baseUrl + 'ajax/add-menu',
                data: $(form).serialize(),
                dataType: "JSON",
                beforeSend: function () {
                    let timerInterval
                    Swal.fire({
                        timer: 1000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                },
                success: function (result) {
                    setTimeout(function () {
                        if (result.error == false) {
                            Swal.fire('Menu Berhasil DItambahkan', '', 'success')
                        } else {
                            Swal.fire(result.error, '', 'info')
                        }
                    }, 750)
                },
                error: function () {
                    Swal.fire('Failed to get contents....', '', 'info')
                },
            })
        } else if (result.isDenied) {
            Swal.fire('Tambah Menu Dibatalkan', '', 'info')
        }
    })
}

function addToCart(id, jumlah, csrf_token) {
    $.ajax({
        type: "POST",
        url: baseUrl + 'ajax/action-cart',
        data: 'idMenu=' + id + '&jumlah=' + jumlah + '&action=add&csrf_token=' + csrf_token,
        dataType: "JSON",
        beforeSend: function () {
            let timerInterval
            Swal.fire({
                timer: 1000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })
        },
        success: function (result) {
            setTimeout(function () {
                if (result.action == 'add') {
                    Swal.fire('Menu Berhasil Ditambahkan Ke Keranjang', '', 'success').then((results) => {
                        if (results) {
                            loadCartData()
                        }
                    })
                } else {
                    Swal.fire(result.error, '', 'info')
                    loadCartData()
                }
            }, 750)
        },
        error: function () {
            Swal.fire('Failed to get contents....', '', 'info')
        },
    })
}

function removeCart(id, csrf_token) {
    Swal.fire({
        title: 'Apakah Anda Ingin Menghapus Menu Dalam List Keranjang?',
        showDenyButton: true,
        icon: 'question',
        confirmButtonText: 'Ya, Hapus',
        denyButtonText: 'Batalkan',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: baseUrl + 'ajax/action-cart',
                data: 'idMenu=' + id + '&action=remove&csrf_token=' + csrf_token,
                dataType: "JSON",
                beforeSend: function () {
                    let timerInterval
                    Swal.fire({
                        timer: 1000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                },
                success: function (result) {
                    setTimeout(function () {
                        if (result.action == 'remove') {
                            Swal.fire('Menu Di Dalam Keranjang Pesanan Berhasil Dihapus', '', 'success').then((results) => {
                                if (results) {
                                    loadCartData()
                                    loadCartDataModal()
                                    if(result.qty < 1) {
                                        $("#myModal").modal("hide")
                                    }
                                }
                            })
                        } 
                    }, 750)
                },
                error: function () {
                    Swal.fire('Failed to get contents....', '', 'info')
                },
            })
        } else if (result.isDenied) {
            Swal.fire('Hapus Keranjang Pesanan Menu Dibatalkan', '', 'info')
        }
    })
}

function loadCartData() {
    $.ajax({
        url: baseUrl + 'ajax/fetch-cart',
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            $('.app-cart-body').html(data.cart_details)
            $('#totalPesanan').html(data.totalPesanan)
            if(data.button == true) {
                $('#cartButton').attr('onclick', "getModal('" + baseUrl + "ajax/detail-cart')")	
            } else {
                $('#cartButton').attr('onclick', "Swal.fire('Keranjang Pesanan Tidak Ada!', '', 'info')")
            }
        }
    })
}

function loadCartDataModal() {
    $('.modal-header').hide()
    $('.modal-footer*').removeClass('d-block')
    $('.modal-footer*').addClass('d-none')
    $.ajax({
        url: baseUrl + 'ajax/fetch-cart-modal.php',
        method: "POST",
        dataType: "JSON",
        beforeSend: function() {
            $('#listPesanan').html('<div class="d-flex justify-content-center"><div class="spinner-border text-secondary" role="status"><span class="visually-hidden">Loading...</span></div></div>')
        },
        success: function(data) {
            setTimeout(function () {
                $('.modal-header').show()
                $('.modal-footer*').removeClass('d-none')
                $('.modal-footer*').addClass('d-block')
                $('#listPesanan').html(data.cart_details)
                $('#totalHarga').html(data.totalPesanan)
                $("#myModal").children().addClass('modal-dialog-scrollable')
            }, 500)
        }
    })
}

function checkoutCart(form) {
    Swal.fire({
        title: 'Apakah Pesanan Anda Sudah Sesuai?',
        showDenyButton: true,
        icon: 'question',
        confirmButtonText: 'Ya, Lanjutkan',
        denyButtonText: 'Batalkan',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: baseUrl + 'ajax/checkout',
                data: $(form).serialize(),
                dataType: "JSON",
                beforeSend: function () {
                    let timerInterval
                    Swal.fire({
                        timer: 1000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                },
                success: function (result) {
                    setTimeout(function () {
                        if (result.error == false) {
                            Swal.fire('Pemesanan Berhasil', '', 'success').then((results) => {
                                if (results) {
                                    loadCartData()
                                    loadCartDataModal()
                                    $("#myModal").modal("hide")
                                    if(result.redirect !== false) {
                                        window.location.replace(result.redirect)
                                    }
                                }
                            })
                        } else {
                            Swal.fire(result.error, '', 'info')
                        }
                    }, 750)
                },
                error: function () {
                    Swal.fire('Failed to get contents....', '', 'info')
                },
            })
        } else if (result.isDenied) {
            Swal.fire('Konfirmasi Pesanan Dibatalkan', '', 'info')
        }
    })
}

function loadMenu(kategori = 'all', cariMenu = '') {
    $.ajax({
        url: baseUrl + 'ajax/fetch-menu',
        data: 'kategori=' + kategori + '&cariMenu=' + cariMenu,
        method: "POST",
        dataType: "JSON",
        success: function(data) {
            $('#menuItems').html(data.listMenu)
        }
    })
}

function loginForm(form) {
    $.ajax({
        type: "POST",
        url: baseUrl + 'ajax/login',
        data: $(form).serialize(),
        dataType: "JSON",
        beforeSend: function () {
            let timerInterval
            Swal.fire({
                timer: 1000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })
        },
        success: function (result) {
            setTimeout(function () {
                if (result.error == false) {
                    Swal.fire('Login Berhasil', '', 'success').then((results) => {
                        if (results) {
                            window.location.replace(result.redirect)
                        }
                    })
                } else {
                    Swal.fire(result.error, '', 'info')
                }
            }, 750)
        },
        error: function () {
            Swal.fire('Failed to get contents....', '', 'info')
        },
    })
}

function loadDataTable(action) {
    $.ajax({
        url: baseUrl + 'ajax/fetch-data',
        data: 'action=' + action,
        method: "POST",
        dataType: "HTML",
        success: function(data) {
            $('#loadData').html(data)
        }
    })
}

function deleteId(action, title, id, csrf_token) {
    Swal.fire({
        title: 'Apakah Anda Ingin Menghapus Data ' + title + '?',
        showDenyButton: true,
        icon: 'question',
        confirmButtonText: 'Ya, Hapus',
        denyButtonText: 'Batalkan',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: baseUrl + 'action/delete',
                data: 'action=' + action + '&id=' + id + '&csrf_token=' + csrf_token,
                dataType: "JSON",
                beforeSend: function () {
                    let timerInterval
                    Swal.fire({
                        timer: 1000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                },
                success: function (result) {
                    setTimeout(function () {
                        if (result.error == false) {
                            Swal.fire('Hapus ' + title + ' Berhasil', '', 'success')
                            loadDataTable(action)
                        } else {
                            Swal.fire(result.error, '', 'info')
                        }
                    }, 750)
                },
                error: function () {
                    Swal.fire('Failed to get contents....', '', 'info')
                },
            })
        } else if (result.isDenied) {
            Swal.fire('Hapus Data ' + title + ' Dibatalkan', '', 'info')
        }
    })
}

function logout() {
    Swal.fire({
        title: 'Apakah Anda Ingin Logout?',
        showDenyButton: true,
        icon: 'question',
        confirmButtonText: 'Ya, Logout',
        denyButtonText: 'Batalkan',
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = baseUrl + 'auth/logout';
        }
    })
}