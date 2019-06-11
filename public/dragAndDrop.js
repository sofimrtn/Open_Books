class OperationDragAndDrop {

    constructor(toMoveNode) {
        this.toMoveNode = toMoveNode;
    }

    drop(e) {
        var copy = this.toMoveNode.cloneNode(true);
        e.target.appendChild(copy);
        alert('Success');
    }

    allowDrop(e) {
        e.preventDefault();
    }

}

var operationDragAndDropCurrent = null;
