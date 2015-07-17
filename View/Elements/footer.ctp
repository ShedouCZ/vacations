<div class="container footerHolder">
    <div class="row">
        <div class="col-md-12 footer">
            <div class="copyright left">
                © <?php echo date('Y');?> Univerzita Karlova v Praze
            </div>
            <div class="right">
                <nav class="navRight">
                    <ul>
                        <?php
                        $help_mail   = Configure::read('Cfg.help_mail');
                        $help_phone  = Configure::read('Cfg.help_phone');
                        $help_phone_dashed = str_replace(' ', '-', $help_phone);
                        ?>
                        <li>Helpline: <a href="tel:+420-<?php echo $help_phone_dashed;?>"><?php echo $help_phone;?></a></li>
                        <li><a href="mailto:<?php echo $help_mail; ?>"><?php echo $help_mail; ?></a></li>
                        <li><a href="http://www.cuni.cz/UK-2000.html">Kontakty</a></li>
                    </ul>
                </nav>
            </div>
            <div class="scrollToTopHelper"></div>
        </div>
    </div>
</div>
<a class="scrollToTop" style="bottom: 1px; left: 1345px;"></a>
