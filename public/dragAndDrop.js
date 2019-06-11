
class OperationDragAndDrop {

    constructor(toMoveNode) {
        this.toMoveNode = toMoveNode;
    }

    drop(e) {
        const copy = this.toMoveNode.cloneNode(true);
        e.target.appendChild(copy);
        //alert('Book succesfully added to your library');
    }

    allowDrop(e) {
        e.preventDefault();
    }
}

var operationDragAndDropCurrent = null;
