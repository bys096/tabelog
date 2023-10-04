<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>食べログ</title>

    <!-- TUI 에디터 CSS CDN -->
{{--    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.css"/>
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
    <link rel="stylesheet" href="https://nhn.github.io/tui.editor/latest/dist/cdn/theme/toastui-editor-dark.css">

</head>
<body>
<h2 style="text-align: center;">Write Diary</h2>

<!-- 에디터를 적용할 요소 (컨테이너) -->
<div id="content">

</div>

<!-- TUI 에디터 JS CDN -->
<script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    async function uploadDiaryImage(formData) {
        try {
            return await axios.post('/diaries', formData, {
                // headers: {   }
            });
        } catch(err) {
            console.log(err);
        }


    }

    const editor = new toastui.Editor({
        el: document.querySelector('#content'), // 에디터를 적용할 요소 (컨테이너)
        height: '500px',                        // 에디터 영역의 높이 값 (OOOpx || auto)
        initialEditType: 'markdown',            // 최초로 보여줄 에디터 타입 (markdown || wysiwyg)
        initialValue: '내용을 입력해 주세요.',     // 내용의 초기 값으로, 반드시 마크다운 문자열 형태여야 함
        previewStyle: 'vertical',                // 마크다운 프리뷰 스타일 (tab || vertical)
        theme: 'dark',

        hooks: {
            async addImageBlobHook(blob, callback) {
                const formData = new FormData();
                formData.append("image", blob);

                try {
                    console.log('upload start');
                    const res = await uploadDiaryImage(formData);
                    console.log('response data:');
                    console.log(res);
                    callback(res.data.imageUrl, `image`);
                } catch (err) {
                    console.log(err);
                }


                // console.log(blob);
                // console.log(callback);


            }
        }
    });


</script>
</body>
</html>
