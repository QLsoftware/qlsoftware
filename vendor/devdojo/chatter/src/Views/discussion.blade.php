@extends(Config::get('chatter.master_file_extend'))

@section(Config::get('chatter.yields.head'))
    @if(Config::get('chatter.sidebar_in_discussion_view'))
        <link href="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.css" rel="stylesheet">
    @endif
    <link href="/vendor/devdojo/chatter/assets/css/chatter.css" rel="stylesheet">
    @if($chatter_editor == 'simplemde')
        <link href="/vendor/devdojo/chatter/assets/css/simplemde.min.css" rel="stylesheet">
    @elseif($chatter_editor == 'trumbowyg')
        <link href="/vendor/devdojo/chatter/assets/vendor/trumbowyg/ui/trumbowyg.css" rel="stylesheet">
        <style>
            .trumbowyg-box, .trumbowyg-editor {
                margin: 0px auto;
            }
        </style>
    @endif
@stop


@section('content')

    <div id="chatter" class="discussion">

        <div id="chatter_header" style="background-color:{{ $discussion->color }}">
            <div class="container">
                <a class="back_btn" href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-back"></i></a>
                <h1>{{ $discussion->title }}</h1><span class="chatter_head_details">{{--Posted In --}}
                    分组于{{--{{ Config::get('chatter.titles.category') }}--}}
                    <a class="chatter_cat"
                       href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.category') }}/{{ $discussion->category->slug }}"
                       style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</a></span>
            </div>
        </div>

        @if(Session::has('chatter_alert'))
            <div class="chatter-alert alert alert-{{ Session::get('chatter_alert_type') }}">
                <div class="container">
                    <strong><i class="chatter-alert-{{ Session::get('chatter_alert_type') }}"></i> {{ Config::get('chatter.alert_messages.' . Session::get('chatter_alert_type')) }}
                    </strong>
                    {{ Session::get('chatter_alert') }}
                    <i class="chatter-close"></i>
                </div>
            </div>
            <div class="chatter-alert-spacer"></div>
        @endif

        @if (count($errors) > 0)
            <div class="chatter-alert alert alert-danger">
                <div class="container">
                    <p><strong><i class="chatter-alert-danger"></i> {{ Config::get('chatter.alert_messages.danger') }}
                        </strong>{{-- Please fix the following errors:--}}请处理以下的错误:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="container margin-top">

            <div class="row">

                @if(! Config::get('chatter.sidebar_in_discussion_view'))
                    <div class="col-md-12">
                        @else
                            <div class="col-md-3 left-column">
                                <!-- SIDEBAR -->
                                <div class="chatter_sidebar">
                                    <button class="btn btn-primary" id="new_discussion_btn"><i class="chatter-new"></i>
                                        创建{{ Config::get('chatter.titles.discussion') }}</button>
                                    <a href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-bubble"></i>
                                        所有{{ Config::get('chatter.titles.discussions') }}</a>
                                    <ul class="nav nav-pills nav-stacked">
                                        <?php $categories = DevDojo\Chatter\Models\Models::category()->all(); ?>
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.category') }}/{{ $category->slug }}">
                                                    <div class="chatter-box"
                                                         style="background-color:{{ $category->color }}"></div> {{ $category->name }}
                                                </a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- END SIDEBAR -->
                            </div>
                            <div class="col-md-9 right-column">
                                @endif

                                <div class="conversation">
                                    <ul class="discussions no-bg" style="display:block;">
                                        @foreach($posts as $post)
                                            <li data-id="{{ $post->id }}" data-markdown="{{ $post->markdown }}">
		                		<span class="chatter_posts">
		                			@if(!Auth::guest() && (Auth::user()->id == $post->user->id))
                                        <div id="delete_warning_{{ $post->id }}" class="chatter_warning_delete">
		                					<i class="chatter-warning"></i>{{--Are you sure you want to delete this response?--}}
                                            你确定删除这个回复吗？
		                					<button class="btn btn-sm btn-danger pull-right delete_response">{{--Yes Delete It--}}
                                                是的</button>
		                					<button class="btn btn-sm btn-default pull-right">{{--No Thanks--}}
                                                取消</button>
		                				</div>
                                        <div class="chatter_post_actions">
			                				<p class="chatter_delete_btn">
			                					<i class="chatter-delete"></i> {{--Delete--}}删除
			                				</p>
			                				<p class="chatter_edit_btn">
			                					<i class="chatter-edit"></i> {{--Edit--}}编辑
			                				</p>
			                			</div>
                                    @endif
                                    <div class="chatter_avatar">
					        			@if(Config::get('chatter.user.avatar_image_database_field'))

                                            <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                                            <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                                                @if( (substr($post->user->{$db_field}, 0, 7) == 'http://') || (substr($post->user->{$db_field}, 0, 8) == 'https://') )
                                                    <img src="{{ $post->user->{$db_field}  }}">
                                                @else
                                                    <img src="{{ $post->user->{$db_field}  }}">
                                                @endif

                                            @else
                                                <span class="chatter_avatar_circle"
                                                      style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($post->user->email) ?>">
					        					{{ ucfirst(substr($post->user->email, 0, 1)) }}
					        				</span>
                                            @endif
					        		</div>

					        		<div class="chatter_middle">
					        			<span class="chatter_middle_details"><a
                                                    href="{{ \DevDojo\Chatter\Helpers\ChatterHelper::userLink($post->user) }}">{{ ucfirst($post->user->{Config::get('chatter.user.database_field_with_user_name')}) }}</a> <span
                                                    class="ago chatter_middle_details">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</span></span>
					        			<div class="chatter_body">

					        				@if($post->markdown)
                                                <pre class="chatter_body_md">{{ $post->body }}</pre>
                                                <?= \DevDojo\Chatter\Helpers\ChatterHelper::demoteHtmlHeaderTags(GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($post->body)); ?>
                                            <!--?= GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $post->body ); ?-->
                                            @else
                                                <?= $post->body; ?>
                                            @endif

					        			</div>
					        		</div>

					        		<div class="chatter_clear"></div>
				        		</span>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>

                                <div id="pagination">{{ $posts->links() }}</div>

                                @if(!Auth::guest())

                                    <div id="new_response">

                                        <div class="chatter_avatar">
                                        @if(Config::get('chatter.user.avatar_image_database_field'))

                                            <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                                            <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                                                @if( (substr(Auth::user()->{$db_field}, 0, 7) == 'http://') || (substr(Auth::user()->{$db_field}, 0, 8) == 'https://') )
                                                    <img src="{{ Auth::user()->{$db_field}  }}">
                                                @else
                                                    <img src="{{ Config::get('chatter.user.relative_url_to_image_assets'). Auth::user()->{$db_field}  }}">
                                                @endif

                                            @else
                                                <span class="chatter_avatar_circle"
                                                      style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode(Auth::user()->email) ?>">
		        					{{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
		        				</span>
                                            @endif
                                        </div>

                                        <div id="new_discussion">


                                            <div class="chatter_loader dark" id="new_discussion_loader">
                                                <div></div>
                                            </div>

                                            <form id="chatter_form_editor"
                                                  action="/{{ Config::get('chatter.routes.home') }}/posts"
                                                  method="POST">

                                                <!-- BODY -->
                                                <div id="editor">
                                                    @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
                                                        <label id="tinymce_placeholder">{{--Type Your Discussion Here...--}}
                                                            在此处输入您的内容</label>
                                                        <textarea id="body" class="richText" name="body"
                                                                  placeholder="">{{ old('body') }}</textarea>
                                                    @elseif($chatter_editor == 'simplemde')
                                                        <textarea id="simplemde" name="body"
                                                                  placeholder="">{{ old('body') }}</textarea>
                                                    @elseif($chatter_editor == 'trumbowyg')
                                                        <textarea class="trumbowyg" name="body"
                                                                  placeholder="Type Your Discussion Here...">{{ old('body') }}</textarea>
                                                    @endif
                                                </div>

                                                <input type="hidden" name="_token" id="csrf_token_field"
                                                       value="{{ csrf_token() }}">
                                                <input type="hidden" name="chatter_discussion_id"
                                                       value="{{ $discussion->id }}">
                                            </form>

                                        </div><!-- #new_discussion -->
                                        <div id="discussion_response_email">
                                            <button id="submit_response" class="btn btn-success pull-right"><i
                                                        class="chatter-new"></i> {{--Submit Response--}}提交回复
                                            </button>
                                            @if(Config::get('chatter.email.enabled'))
                                                <div id="notify_email">
                                                    <img src="/vendor/devdojo/chatter/assets/images/email.gif"
                                                         class="chatter_email_loader">
                                                    <!-- Rounded toggle switch -->
                                                    <span>{{--Notify me when someone replies--}}有回复时请邮件通知我</span>
                                                    <label class="switch">
                                                        <input type="checkbox" id="email_notification"
                                                               name="email_notification" @if(!Auth::guest() && $discussion->users->contains(Auth::user()->id)){{ 'checked' }}@endif>
                                                        <span class="on">{{--Yes--}}是</span>
                                                        <span class="off">{{--No--}}否</span>
                                                        <div class="slider round"></div>
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                @else

                                    <div id="login_or_register">
                                        <p>{{--Please--}}请 <a
                                                    href="/{{ Config::get('chatter.routes.home') }}/login">{{--login--}}
                                                登陆</a> {{--or--}}或者 <a
                                                    href="/{{ Config::get('chatter.routes.home') }}/register">{{--register--}}
                                                注册</a> {{--to leave a response.--}}然后留下您的回复</p>
                                    </div>

                                @endif

                            </div>


                    </div>
            </div>

            @if(Config::get('chatter.sidebar_in_discussion_view'))
                <div id="new_discussion_in_discussion_view">

                    <div class="chatter_loader dark" id="new_discussion_loader_in_discussion_view">
                        <div></div>
                    </div>

                    <form id="chatter_form_editor_in_discussion_view"
                          action="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}"
                          method="POST">
                        <div class="row">
                            <div class="col-md-7">
                                <!-- TITLE -->
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Title of {{ Config::get('chatter.titles.discussion') }}"
                                       v-model="title" value="{{ old('title') }}">
                            </div>

                            <div class="col-md-4">
                                <!-- CATEGORY -->
                                <select id="chatter_category_id" class="form-control" name="chatter_category_id">
                                    <option value="">{{--Select a Category--}}请选择一个分组</option>
                                    @foreach($categories as $category)
                                        @if(old('chatter_category_id') == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-1">
                                <i class="chatter-close"></i>
                            </div>
                        </div><!-- .row -->

                        <!-- BODY -->
                        <div id="editor">
                            @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
                                <label id="tinymce_placeholder">{{--Add the content for your Discussion here--}}
                                    在此处为话题添加内容</label>
                                <textarea id="body_in_discussion_view" class="richText" name="body"
                                          placeholder="">{{ old('body') }}</textarea>
                            @elseif($chatter_editor == 'simplemde')
                                <textarea id="simplemde_in_discussion_view" name="body"
                                          placeholder="">{{ old('body') }}</textarea>
                            @elseif($chatter_editor == 'trumbowyg')
                                <textarea class="trumbowyg" name="body" placeholder="">{{ old('body') }}</textarea>
                            @endif
                        </div>

                        <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

                        <div id="new_discussion_footer">
                            <input type='text' id="color" name="color"/><span class="select_color_text">{{--Select a Color for this Discussion (optional)--}}
                                为你的话题选个颜色(可选)</span>
                            <button id="submit_discussion" class="btn btn-success pull-right"><i
                                        class="chatter-new"></i> Create {{ Config::get('chatter.titles.discussion') }}
                            </button>
                            <a href="/{{ Config::get('chatter.routes.home') }}" class="btn btn-default pull-right"
                               id="cancel_discussion">Cancel</a>
                            <div style="clear:both"></div>
                        </div>
                    </form>

                </div><!-- #new_discussion -->
            @endif

        </div>

        @if($chatter_editor == 'tinymce' || empty($chatter_editor))
            <input type="hidden" id="chatter_tinymce_toolbar" value="{{ Config::get('chatter.tinymce.toolbar') }}">
            <input type="hidden" id="chatter_tinymce_plugins" value="{{ Config::get('chatter.tinymce.plugins') }}">
        @endif
        <input type="hidden" id="current_path" value="{{ Request::path() }}">

        @stop

        @section(Config::get('chatter.yields.footer'))

            @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
                <script>var chatter_editor = 'tinymce';</script>
                <script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
                <script src="/vendor/devdojo/chatter/assets/js/tinymce.js"></script>
                <script>
                    var my_tinymce = tinyMCE;
                    $('document').ready(function () {

                        $('#tinymce_placeholder').click(function () {
                            my_tinymce.activeEditor.focus();
                        });

                    });
                </script>
            @elseif($chatter_editor == 'simplemde')
                <script>var chatter_editor = 'simplemde';</script>
                <script src="/vendor/devdojo/chatter/assets/js/simplemde.min.js"></script>
                <script src="/vendor/devdojo/chatter/assets/js/chatter_simplemde.js"></script>
            @elseif($chatter_editor == 'trumbowyg')
                <script>var chatter_editor = 'trumbowyg';</script>
                <script src="/vendor/devdojo/chatter/assets/vendor/trumbowyg/trumbowyg.min.js"></script>
                <script src="/vendor/devdojo/chatter/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js"></script>
                <script src="/vendor/devdojo/chatter/assets/js/trumbowyg.js"></script>
            @endif

            @if(Config::get('chatter.sidebar_in_discussion_view'))
                <script src="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js"></script>
                <script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>
            @endif

            <script>
                $('document').ready(function () {

                    var simplemdeEditors = [];

                    $('.chatter_edit_btn').click(function () {
                        parent = $(this).parents('li');
                        parent.addClass('editing');
                        id = parent.data('id');
                        markdown = parent.data('markdown');
                        container = parent.find('.chatter_middle');

                        if (markdown) {
                            body = container.find('.chatter_body_md');
                        } else {
                            body = container.find('.chatter_body');
                            markdown = 0;
                        }

                        details = container.find('.chatter_middle_details');

                        // dynamically create a new text area
                        container.prepend('<textarea id="post-edit-' + id + '"></textarea>');
                        // Client side XSS fix
                        $("#post-edit-" + id).text(body.html());
                        container.append('<div class="chatter_update_actions"><button class="btn btn-success pull-right update_chatter_edit"  data-id="' + id + '" data-markdown="' + markdown + '"><i class="chatter-check"></i> Update Response</button><button href="/" class="btn btn-default pull-right cancel_chatter_edit" data-id="' + id + '"  data-markdown="' + markdown + '">Cancel</button></div>');

                        // create new editor from text area
                        if (markdown) {
                            simplemdeEditors['post-edit-' + id] = newSimpleMde(document.getElementById('post-edit-' + id));
                        } else {
                            @if($chatter_editor == 'tinymce' || empty($chatter_editor))
                                initializeNewTinyMCE('post-edit-' + id);
                            @elseif($chatter_editor == 'trumbowyg')
                                initializeNewTrumbowyg('post-edit-' + id);
                            @endif
                        }

                    });

                    $('.discussions li').on('click', '.cancel_chatter_edit', function (e) {
                        post_id = $(e.target).data('id');
                        markdown = $(e.target).data('markdown');
                        parent_li = $(e.target).parents('li');
                        parent_actions = $(e.target).parent('.chatter_update_actions');
                        if (!markdown) {
                            @if($chatter_editor == 'tinymce' || empty($chatter_editor))
                                tinymce.remove('#post-edit-' + post_id);
                            @elseif($chatter_editor == 'trumbowyg')
                                $(e.target).parents('li').find('.trumbowyg').fadeOut();
                            @endif
                        } else {
                            $(e.target).parents('li').find('.editor-toolbar').remove();
                            $(e.target).parents('li').find('.editor-preview-side').remove();
                            $(e.target).parents('li').find('.CodeMirror').remove();
                        }

                        $('#post-edit-' + post_id).remove();
                        parent_actions.remove();

                        parent_li.removeClass('editing');
                    });

                    $('.discussions li').on('click', '.update_chatter_edit', function (e) {
                        post_id = $(e.target).data('id');
                        markdown = $(e.target).data('markdown');

                        if (markdown) {
                            update_body = simplemdeEditors['post-edit-' + post_id].value();
                        } else {
                            @if($chatter_editor == 'tinymce' || empty($chatter_editor))
                                update_body = tinyMCE.get('post-edit-' + post_id).getContent();
                            @elseif($chatter_editor == 'trumbowyg')
                                update_body = $('#post-edit-' + id).trumbowyg('html');
                            @endif
                        }

                        $.form('/{{ Config::get('chatter.routes.home') }}/posts/' + post_id, {
                            _token: '{{ csrf_token() }}',
                            _method: 'PATCH',
                            'body': update_body
                        }, 'POST').submit();
                    });

                    $('#submit_response').click(function () {
                        $('#chatter_form_editor').submit();
                    });

                    // ******************************
                    // DELETE FUNCTIONALITY
                    // ******************************

                    $('.chatter_delete_btn').click(function () {
                        parent = $(this).parents('li');
                        parent.addClass('delete_warning');
                        id = parent.data('id');
                        $('#delete_warning_' + id).show();
                    });

                    $('.chatter_warning_delete .btn-default').click(function () {
                        $(this).parent('.chatter_warning_delete').hide();
                        $(this).parents('li').removeClass('delete_warning');
                    });

                    $('.delete_response').click(function () {
                        post_id = $(this).parents('li').data('id');
                        $.form('/{{ Config::get('chatter.routes.home') }}/posts/' + post_id, {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        }, 'POST').submit();
                    });

                    // logic for when a new discussion needs to be created from the slideUp
                    @if(Config::get('chatter.sidebar_in_discussion_view'))
                        $('.chatter-close').click(function () {
                        $('#new_discussion_in_discussion_view').slideUp();
                    });
                    $('#new_discussion_btn, #cancel_discussion').click(function () {
                        @if(Auth::guest())
                            window.location.href = "/{{ Config::get('chatter.routes.home') }}/login";
                        @else
                            $('#new_discussion_in_discussion_view').slideDown();
                        $('#title').focus();
                        @endif
                    });

                    $("#color").spectrum({
                        color: "#333639",
                        preferredFormat: "hex",
                        containerClassName: 'chatter-color-picker',
                        cancelText: '',
                        chooseText: 'close',
                        move: function (color) {
                            $("#color").val(color.toHexString());
                        }
                    });

                    @if (count($errors) > 0)
                        $('#new_discussion_in_discussion_view').slideDown();
                    $('#title').focus();
                    @endif
                    @endif

                });
            </script>

            <script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>

@stop
