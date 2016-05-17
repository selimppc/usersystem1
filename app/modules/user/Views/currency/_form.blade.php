<script src="assets/bitd/js/jquery.min.js"></script>
{{--<script src="assets/bitd/js/jquery-ui.min.js"></script>--}}
<div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

    <div class="row">
        <div class="col-sm-6 form-group">
            {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
            {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','placeholder'=>'Title','required','autofocus', 'title'=>'Enter Title']) !!}
        </div>
        <div class="col-sm-6">
            {!! Form::label('value', 'Value:', ['class' => 'control-label']) !!}
            {!! Form::text('value',Input::old('value'),['class' => 'form-control','placeholder'=>'Value','required', 'title'=>'Enter Value']) !!}
        </div>
        <div class="col-sm-12">
            {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
            {!! Form::textarea('description',Input::old('description'),['class' => 'form-control','placeholder'=>'Description','required', 'title'=>'Enter Description']) !!}
        </div>
    </div>
</div>

{{--<script type="text/javascript" src="{{ URL::asset('assets/admin/js/datepicker.js') }}"></script>--}}


<script>

    function validation() {
        $('#re-password').on('keyup', function () {
            if ($(this).val() == $('#user-password').val()) {

                $('#show-message').html('');
                document.getElementById("btn-disabled").disabled = false;
                return false;
            }
            else $('#show-message').html('confirm password do not match with new password,please check.').css('color', 'red');
            document.getElementById("btn-disabled").disabled = true;
        });
    }

</script>

<script>


        $(function () {
            $("#form_2").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    max: {
                        required: true,
                        maxlength: 4
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            $("#form_2").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    last_name: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    number: {
                        required: "(Please enter your phone number)",
                        number: "(Please enter valid phone number)"
                    },
                    last_name: {
                        required: "This is custom message for required",
                        minlength: "This is custom message for min length"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                },
                errorPlacement: function (error, element) {
                    $(element)
                            .closest("form")
                            .find("label[for='" + element.attr("id") + "']")
                            .append(error);
                },
                errorElement: "span",
            });
        });

</script>
