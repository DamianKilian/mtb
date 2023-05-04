import { useState } from "react";

import Modal from "./Modal";

function Email(props) {
    const [emailSent, setEmailSent] = useState(false);
    function onSubmit(e) {
        e.preventDefault();
        var formData = new FormData(e.currentTarget);
        axios
            .post(props.project.routes.email, formData)
            .then(function (response) {
                if(1 === response.data){
                    setEmailSent(true);
                }
            })
            .catch(function (error) {
                console.debug(error);
            });
    }
    function onBtnClick(e) {
        setEmailSent(false);
        props.openModalHandler(e);
    }
    return (
        <>
            <a className="btn btn-primary" onClick={onBtnClick}>
                {"Email"}
            </a>
            {props.modalIsOpen && (
                <Modal
                    onCancel={props.closeModalHandler}
                    route={props.project.routes.destroy}
                    text="Email project?"
                    method="POST"
                    c="primary"
                    title="Email"
                    onSubmit={onSubmit}
                    emailSent={emailSent}
                >
                    <input
                        id="email-project"
                        name="email"
                        type="email"
                    />
                    <hr />
                </Modal>
            )}
        </>
    );
}

export default Email;
