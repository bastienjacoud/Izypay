        @if($erreur!= "")
        <div role="alert">
            <p id="texte_erreur">
                <i class="fas fa-exclamation-triangle" id="erreur"></i> {{ $erreur or '' }}
            </p>
        </div>
      @endif