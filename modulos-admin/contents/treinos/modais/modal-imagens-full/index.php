<style>
  #container-imagem-full {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 85vh;
    width: 85vw; 
  }
  #imagem-full {
    max-width: 100%; 
    max-height: 100%;
    object-fit: contain; 
  }

  @media(max-width:992px){
    #container-imagem-full {
      height: 98vh;
      width: 98vw; 
    }
  }
</style>


<!-- modal imagens full -->
<div class="modal fade" id="modal-imagens-full" tabindex="-1" aria-labelledby="modal-imagens-fullLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="w-100 d-flex justify-content-center">

        <div id="container-imagem-full">
          <img id="imagem-full">
        </div>

    </div>
  </div>
</div>
<!-- modal imagens full -->
