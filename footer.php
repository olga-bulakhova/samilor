<?php $expo_theme_info = expo_theme_info(); ?>

<footer class="expo-footer">
    <div class="wrapper">
        <div class="footer-title mb-2">Контакты</div>
        <div class="footer-text mb-1">Телефоны:
            <?php if (! empty($expo_theme_info['phone_1'])): ?>
                <a href="tel:+<?php echo str_replace(array(' ', '-', '+'), array('', '', ''), $expo_theme_info['phone_1']) ?>"><?php echo $expo_theme_info['phone_1'] ?></a>
            <?php endif; ?>
            &nbsp;
            <?php if (! empty($expo_theme_info['phone_2'])): ?>
                <a href="tel:+<?php echo str_replace(array(' ', '-', '+'), array('', '', ''), $expo_theme_info['phone_2']) ?>"><?php echo $expo_theme_info['phone_2'] ?></a>
            <?php endif; ?>
        </div>
        <div class="footer-text">
            © Copyright <?php echo date("Y"); ?>, Prince Toys | <a href="/privacy-policy/">Privacy policy</a>
        </div>
        <!-- <?php if (! empty($expo_theme_info['address'])): ?>
             <div class="footer-text">Адрес: <?php echo $expo_theme_info['address'] ?></div>
             <?php endif; ?> -->
    </div>
</footer>
</div>

<?php wp_footer(); ?>

</body>

</html>