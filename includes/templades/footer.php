<footer class="footer">
  <div class="ContenedorFooter">
    <nav>
      <a href="../../Properties.php">Propiedades</a>
      <a href="../../Blog.php">Blog</a>
      <a href="../../AboutKeysHomes.php">Nosotros</a>
      <?php if ($auth): ?>
        <a href="../../CloseSession.php">Cerrar sesión</a>
      <?php endif ?>
    </nav>

    <div class="SocialIcons">
      <a href="#" target="_blank" class="SocialIcon Instagram">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="#" target="_blank" class="SocialIcon Facebook">
        <i class="fab fa-facebook"></i>
      </a>
      <a href="#" target="_blank" class="SocialIcon X">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
        </svg>
        <i class="fab fa-x-twitter"></i>
      </a>
    </div>
  </div>
</footer>

</div> <!--end of div with class AllContent. The start is in header and navigation -->