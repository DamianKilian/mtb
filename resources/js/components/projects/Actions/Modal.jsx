function Modal(props) {
    if (props.emailSent) {
        return (
            <>
                <div
                    onClick={props.onCancel}
                    className="modal fade show"
                    tabIndex="-1"
                    role="dialog"
                    style={{ display: "block" }}
                >
                    <div
                        className="modal-dialog modal-dialog-centered"
                        role="document"
                    >
                        <div className="modal-content">
                            <div className="modal-body">
                                Email sent
                            </div>
                            <div className="modal-footer"></div>
                        </div>
                    </div>
                </div>
                <div className="modal-backdrop fade show"></div>
            </>
        );
    }

    return (
        <>
            <div
                onClick={props.onCancel}
                className="modal fade show"
                tabIndex="-1"
                role="dialog"
                style={{ display: "block" }}
            >
                <div
                    className="modal-dialog modal-dialog-centered"
                    role="document"
                >
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5
                                className="modal-title"
                                id="exampleModalLongTitle"
                            >
                                {props.title}
                            </h5>
                            <button
                                type="button"
                                className="btn close close-modal"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">
                                    <i className="fa-solid fa-xmark"></i>
                                </span>
                            </button>
                        </div>
                        <div className="modal-body">{props.text}</div>
                        <div className="modal-footer">
                            <form
                                id="destroy-restore-form"
                                action={props.route}
                                method="POST"
                                onSubmit={
                                    props.onSubmit ? props.onSubmit : undefined
                                }
                            >
                                <input
                                    type="hidden"
                                    name="_method"
                                    value={props.method}
                                />
                                <input
                                    type="hidden"
                                    name="_token"
                                    value={csrf}
                                />
                                {props.children}
                                <button
                                    type="submit"
                                    className={`btn btn-${props.c}`}
                                >
                                    {props.title}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div className="modal-backdrop fade show"></div>
        </>
    );
}

export default Modal;
