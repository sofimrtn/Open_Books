
class OperationDragAndDrop {

    constructor(toMoveNode) {
        this.toMoveNode = toMoveNode;
    }

    drop(e) {
        var copy = this.toMoveNode.cloneNode(true);
        e.target.appendChild(copy);
        alert('Book succesfully added to your library');
    }

    allowDrop(e) {
        e.preventDefault();
    }

    static allowDrop(e) {
        e.preventDefault();
    }
}

let operationDragAndDropCurrent = null;
