<main role="main">
    <div class="container">
      <div class="card shadow">
          <div class="card-header bg-secondary text-light">

          </div>
          <div class="card-body">
            <form action="http://localhost/proyectoeducativo/Aprendizajes_esperados/get_aprendizajes_esperados" method="POST" name="formulario">
              idnivel: <input type="text" name="idnivel" value="3">
              idcomponente: <input type="text" name="idcomponente" value="1">
              idcampo: <input type="text" name="idcampo" value="1">
              idgrado: <input type="text" name="idgrado" value="2">
              idasignatura: <input type="text" name="idasignatura" value="3">
              ideje: <input type="text" name="ideje" value="0">
              idtema: <input type="text" name="idtema" value="0">
              logo: <input type="text" name="logo" value="data:image/image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAACWCAYAAADwkd5lAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQyIDc5LjE2MDkyNCwgMjAxNy8wNy8xMy0wMTowNjozOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo1MzkyNzE4MkQ3RjAxMUVBOTVGNkE4ODZFQkM4MzU1MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo1MzkyNzE4M0Q3RjAxMUVBOTVGNkE4ODZFQkM4MzU1MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjUzOTI3MTgwRDdGMDExRUE5NUY2QTg4NkVCQzgzNTUxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjUzOTI3MTgxRDdGMDExRUE5NUY2QTg4NkVCQzgzNTUxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+gxdZjwAAJbRJREFUeNrsnQl8HMWZ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">
              estilo: <input type="text" name="estilo" value="https://ec2-34-215-19-76.us-west-2.compute.amazonaws.com/qualiclass/assets/DEMO/css/eclase/main-selva.css   ">
                <input type="submit" value="Enviar">
            </form>

            <div class="row">
              <button type="button" name="button" id="btn_ejemplo">ejemplo</button>
            </div>
          </div>
        </div>
    </div>
</main>

<script src="<?= base_url('assets/js/ejemplo/ejemplo.js') ?>"></script>