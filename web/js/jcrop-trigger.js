/**
 * Created by manideep.bollu on 1/28/2015.
 */
function displayUrlImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#jcrop-preview').attr('src', e.target.result).Jcrop({
                onChange: showCoords,
                onSelect: showCoords,
                setSelect:   [ 0, 0, 250, 250 ],
                aspectRatio: 1,
                boxWidth: 450,
                boxHeight: 450
            });
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function showCoords(c)
{
    $('#jcrop-x1').val(c.x);
    $('#jcrop-y1').val(c.y);
    $('#jcrop-w').val(c.w);
    $('#jcrop-h').val(c.h);
};
