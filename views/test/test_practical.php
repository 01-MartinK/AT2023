<!-- import custom markup JS -->
<script src="assets/js/codemirror.js"></script>
<div id="practical-questions">
    <article>
        <ul>
            <h2 class="toDo">Lahenda järgmised ülesanded:</h2>
            <?php foreach ($practicalQuestions[1] as $practicalQuestion): ?>

                <li>
                    <label>
                        <?= $practicalQuestion ?>
                    </label>
                </li>
            <?php endforeach ?>
        </ul>
    </article>
</div>

<?php if($this->settings['livehtml'] == 1): ?>
<div class="row">
    <div class="col-md-6">
        <form action="test/result" method="post" id="target">
            <div class="practical-div"><mark class="practical-heading center"><h2>Koodi kirjutamine:</h2></mark></div>
            <textarea wrap="hard" name="validateHTML" id="code" class="validateHTML""></textarea>
            <br>
            <input type="hidden" value="Submit">
            <a href="#" id="submit-practical" class="btn btn-info btn-lg form-button" data-toggle="modal"
               data-target=".confirm">Esita</a>
            <br>
        </form>
    </div>
    <div class="col-md-6">
        <div class="center">
            <div class="preview-div"><h2 class="preview-heading center">Eelvaade:</h2></div>
        </div>
        <iframe id="preview"></iframe>
    </div>
</div>

<script>
    // start the live editor magic! :)
    $( document ).ready(function() {
        var delay;

        editor.on("change", function () {
            clearTimeout(delay);
            delay = setTimeout(updatePreview, 30);
        });

        function updatePreview() {
            var previewFrame = document.getElementById('preview');
            var preview = previewFrame.contentDocument || previewFrame.contentWindow.document;
            preview.open();
            preview.write(editor.getValue());
            preview.close();
        }
        setTimeout(updatePreview, 30);
    });

</script>

<?php else: ?>

<form action="test/result" method="post" id="target">
    <div class="practical-div"><mark class="practical-heading center"><h2>Koodi kirjutamine:</h2></mark></div>
    <textarea wrap="hard" name="validateHTML" id="code" class="validateHTML""></textarea>
    <br>
    <input type="hidden" value="Submit">
    <a href="#" id="submit-practical" class="btn btn-info btn-lg form-button" data-toggle="modal"
       data-target=".confirm">Esita</a>
    <br>
</form>
<?php endif; ?>

<!-- Confirm modal -->
<div class="modal fade confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Oled sa kindel, et soovid esitada lahendust?</h4>
            </div>
            <div class="modal-footer">
                <button id="yes" type="button" class="btn btn-default" data-dismiss="modal">Jah</button>
                <button id="no" type="button" class="btn btn-primary">Ei</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>

    $("#yes").click(function () {
        $("#target").submit();
    });
    $("#no").click(function () {
        $('.confirm').modal('hide');
    });

    var mixedMode = {
        name: "htmlmixed",
        scriptTypes: [{
            matches: /\/x-handlebars-template|\/x-mustache/i,
            mode: null
        },
            {
                matches: /(text|application)\/(x-)?vb(a|script)/i,
                mode: "vbscript"
            }]
    };

    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        mode: mixedMode
    });

</script>

