@php $routeName = request()->route()->getName(); @endphp

    <footer style="background: #202739;border-top: 1px solid #2e3752;" class="px-4">
        <div class="container">
            <div class="row py-5 gy-3">
                <div class="col-md-7 col-sm-12">
                    <h6 class="pt-2 text-white">About Us</h6>
                    <p class="text-sm text-secondary fw-light mb-0">{{ env('APP_NAME') }} {{ env('APP_DESC') }}</p>
                </div>
                
                <div class="col-md-2 col-sm-6">
                    <h6 class="pt-2 text-white">Useful links</h6>
                    <div class="d-flex flex-wrap">
                        <ul class="list-unstyled mb-0 mb-3 me-4">
                            @if(Auth::check())
                                <li><a class="text-secondary text-sm mb-2" href="{{ url('account/') }}">[#] TRANSACTIONS</a></li>
                                <li><a class="text-secondary text-sm mb-2" href="{{ url('account/setting') }}">[#] SETTINGS</a></li>
                            @else
                                <li><a class="text-secondary text-sm mb-2" href="{{ url('auth/login') }}">[#] LOGIN</a></li>
                                <li><a class="text-secondary text-sm mb-2" href="{{ url('auth/register') }}">[#] REGISTER</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <h6 class="pt-2 text-white">{{ env('APP_NAME') }} Support</h6>
                    <a class="text-secondary text-sm" href="#!">E-MAIL : HELP@BISOKOP.COM</a>
                    <h6 class="pt-3 text-white">Follow Us</h6>
                    <ul class="list-inline mb-0 mt-2">
                        <li class="list-inline-item"><a class="text-sm text-secondary" href="#!"><ion-icon name="logo-instagram"></ion-icon></a></li>
                        <li class="list-inline-item"><a class="text-sm text-secondary" href="#!"><ion-icon name="logo-facebook"></ion-icon></a></li>
                        <li class="list-inline-item"><a class="text-sm text-secondary" href="#!"><ion-icon name="logo-tiktok"></ion-icon></a></li>
                        <li class="list-inline-item"><a class="text-sm text-secondary" href="#!"><ion-icon name="logo-youtube"></ion-icon></a></li>
                        <li class="list-inline-item"><a class="text-sm text-secondary" href="#!"><ion-icon name="logo-twitter"></ion-icon></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyrights px-4 py-4" style="background: #1d2333;border-top: 1px solid #2e3752;">
        <div class="container">
            <div class="row text-center gy-2">
                <div class="col-sm-6 text-sm-start">
                    <p class="mb-0 mb-0 text-sm text-light">© {{ env('APP_NAME') }} 2023 All rights reserved.</p>
                </div>
                <div class="col-sm-6 text-sm-end">
                    <p class="mb-0 mb-0 text-sm text-light">Made with <ion-icon name="heart" class="text-danger"></ion-icon> by Kelompok 5.</p>
                </div>
            </div>
        </div>
    </div>