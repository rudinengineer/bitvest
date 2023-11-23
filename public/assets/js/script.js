function question(text, url = window.location.href) {
    Swal.fire({
        icon: 'question',
        title: 'Apakah kamu yakin?',
        text: text,
        showCancelButton: true
    }).then((e) => {
        if ( e.isConfirmed ) {
            window.location.href = url
        }
    })
}