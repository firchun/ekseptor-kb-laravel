<footer class="footer section gray-bg">
    <div class="container">


        <div class="footer-btm py-4 mt-5">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                    <div class="copyright">
                        Copyright &copy; {{ date('Y') }}, Designed &amp; Developed by <a
                            href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="subscribe-form text-lg-right mt-5 mt-lg-0">
                        <form action="#" class="subscribe">
                            <input type="text" class="form-control" placeholder="Your Email address" required>
                            <button type="submit" class="btn btn-main-2 btn-round-full">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <a class="backtop scroll-top-to" href="#top">
                        <i class="icofont-long-arrow-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
