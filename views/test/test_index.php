<!-- main html generator -->
<h1 class="quiz-title">HTML & CSS - Vali õige vastus!</h1>
<form action="test/practical " method="POST" id="quiz">
    <?php foreach ($questions as $question): ?>
        <div class="question-box">
            <h2><?= $question['question'] ?></h2>
            <ul>
                <!-- Generate questions list -->
                <?php foreach ($question['answers'] as $answer): ?>
                    <li>
                        <input type="radio" id="<?= $answer['id'] ?>" name="answers[<?= $question['question_id'] ?>]"
                               value="<?= $answer['id'] ?>">
                        <label for="<?= $answer['id'] ?>"><?= $answer['text'] ?></label>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endforeach ?>
    <!-- End php foreach functionality -->
    <a href="#" id="submit-quiz" class="btn btn-lg"
       data-toggle="modal" data-target=".confirm">
        Esita
    </a>
</form>

<!-- Divider -->
<br />
<br />
<br />
<br />

<!-- SUBMIT CONFIRM MODAL -->
<div class="modal fade confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Oled sa kindel, et soovid esitada lahendust?</h3>
                <h4 id="checked"></h4>
            </div>
            <div class="modal-footer">
                <button id="yes-theoretical" type="button" class="modal-btn btn btn-primary" data-dismiss="modal">
                    Jah
                </button>
                <button id="no" type="button" class="modal-btn btn btn-primary" data-dismiss="modal">Ei</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        // if some questions are left unanswered then warn the user
        $("#submit-quiz").click(function () {
            countUnansweredQuestions(<?= count($questions); ?>);
        });

    });

</script>