// Preview the picture when the user selects it
if (document.getElementById('Picture_imageFile_file')){
    console.log('input found !')
    let input = document.getElementById('Picture_imageFile_file')
    let previewDiv = document.getElementById('Picture_imageFile_file_new_file_name')

    input.addEventListener('change', function(e){
        console.log('input changed ! ')
        let file = e.target.files[0]
        let reader = new FileReader()
        reader.onload = function(e){
            console.log('reader loaded !')
            let img = document.createElement('img')
            img.src = e.target.result
            previewDiv.removeChild(previewDiv.firstChild)
            previewDiv.appendChild(img)
        }
        reader.readAsDataURL(file)
    })


}