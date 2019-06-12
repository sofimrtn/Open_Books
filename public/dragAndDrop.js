class OperationDragAndDrop {

    constructor(toMoveNode) {
        this.toMoveNode = toMoveNode;
    }

    drop(e) {
        var copy = this.toMoveNode.cloneNode(true);
        e.target.appendChild(copy);
        $.get(
            'public/loadFavorite.php',
            {
                title: copy.getAttribute('data-title'),
                isbn: copy.getAttribute('data-isbn'),
                portada: copy.getAttribute('data-cover')
            },
            function (result) {
                if (result.result) {
                    alert('Book successfully added to your library');
                }
                else {
                    alert('ERROR: ' + result.error);
                }
            }
        )
    }

    allowDrop(e) {
        e.preventDefault();
    }

}

var operationDragAndDropCurrent = null;
