
Function Name: add_footer

Docstring: This function adds a footer element to the HTML page. It includes the copyright information, digital partner credit, and links to privacy and terms pages.

Purpose: The purpose of this functionality is to provide a consistent and professional look to the HTML pages in software development. It also allows for easy navigation to important information, such as privacy and terms, for website users. Additionally, having a standard footer across all pages helps with branding and credibility.<!-- FOOTER -->
<footer class="main-footer">
    <div class="footer-bottom">
        <div class="container d-lg-flex d-sm-flex flex-wrap justify-content-lg-between justify-content-sm-between text-center">				
            <ul class="copyright-widget list-unstyled d-flex flex-wrap justify-content-center mb-0">
                <li>© 
                    <span id="copyright">
                        <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                    </span> Mantaray
                </li>
                <li>    
                    <small>Digital Partner</small> <a href="https://www.indusnet.co.in/" target="_blank">Indus Net Technologies</a>
                </li>
            </ul>
            <ul class="bottom-links list-unstyled mb-0 d-flex flex-wrap justify-content-center">
                <li><a href="javascript:void(0);">Privacy</a></li>
                <li><a href="javascript:void(0);">Terms</a></li>
            </ul>
        </div>
    </div>
</footer>
<!-- // END FOOTER -->
