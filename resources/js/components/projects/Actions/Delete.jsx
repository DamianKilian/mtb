import Modal from "./Modal";

function Delete(props) {
    return (
        <>
            <a className="btn btn-danger" onClick={props.openModalHandler}>
                {"Delete"}
            </a>
            {props.modalIsOpen && (
                <Modal
                    onCancel={props.closeModalHandler}
                    route = {props.project.routes.destroy}
                    text = "Delete project?"
                    method = "DELETE"
                    c = "danger"
                    title = "Delete"
                />
            )}
        </>
    );
}

export default Delete;
