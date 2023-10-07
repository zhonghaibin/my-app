<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0" />
    <title>s3 Upload</title>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.19.0.min.js"></script>
</head>
<body>
<input type="file" id="file-chooser" />
<button id="upload-button">Upload to S3</button>
<div id="results"></div>

<script type="text/javascript">
    // set variables for click handlers
    const fileChooser = document.getElementById('file-chooser');
    const button = document.getElementById('upload-button');
    const results = document.getElementById('results');

    button.addEventListener('click', function () {
        const file = fileChooser.files[0];
        if (file) {
            AWS.config.update({
                "accessKeyId": "whwU2NQRUxemUnp5Vsog",
                "secretAccessKey": "lIbnTGjOjCzr1cuSlNNZkeKSe6kofPmIXQNhEDBR",
                "s3ForcePathStyle": true,
                "region": "us-west-2",
                "endpoint":"https://oss.neijuan.fun",
                "signatureVersion":"v4"
            });
            const s3 = new AWS.S3();
            const params = {
                Bucket: 'my-app',
                Key: file.name,
                ContentType: file.type,
                Body: file,
                ACL: 'public-read'
            };
            s3.putObject(params, function (err, res) {
                if (err) {
                    results.innerHTML = ("Error uploading data: ", err);
                } else {
                    console.log(res)
                    results.innerHTML = ("Successfully uploaded data");
                }
            });
        } else {
            results.innerHTML = 'Nothing to upload.';
        }
    }, false);
</script>

</body>
</html>
