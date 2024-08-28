<?php
class UsersController extends Controller
{
    private $data = array();

    public function __construct()
    {
        $user = new Users();
        if (!$user->isLogged()) {
            header('Location: ' . BASE_URL . 'Login');
            exit;
        } else {
            $user->setLoggedUser();
            $this->data["name"] = $user->getName();
        }
    }

    public function index($success = null)
    {
        $this->data['title'] = "Quality Juá";
        $this->data['nivel-1'] = 'Configurações';
        $this->data['nivel-2'] = "Usuarios";

        $users = new Users();
        $users->setLoggeduser();

        // verifying if the users have access permission
        if ($users->hasPermission('add_user')) {

            $email_send = new Email();
            $hashUsers = new HashUsers();


            if (!empty($success)) {
                if ($success == 'new_user') {
                    $this->data['success'] = message()->success('Usuário cadastrado com sucesso! peça para verificar o e-mail/caixa de spam para cadastrar uma nova senha. :)');
                } elseif ($success == 'edit_user') {
                    $this->data['success'] = message()->success('Usuário editado com sucesso! :)');
                }
            }


            // Adicionando um usuario
            if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['type_user']) && !empty($_POST['type_user'])) {
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $id_group = 1;
                $type_user = addslashes($_POST['type_user']);
                $hash_email = md5($email);

                if ($type_user == 'adm') {
                    $type_user = 1;
                } else {
                    $type_user = 0;
                }

                if (empty(trim($name))) {
                    $this->data['Erro'] = message()->warning('Não é possivel inserir espaços em brancos');
                } else {
                    if (is_email($email)) {

                        if (!$users->verifyEmail($email)) {
                            $subject = "Login de Acesso";
                            $info = array();
                            $info['email'] = $email;
                            $info['hash'] = $hash_email;

                            ob_start();
                            $this->loadView('Email/invite', $info);
                            $message = ob_get_clean();

                            $email_send->bootstrap($subject, $message, $email, $name);

                            if ($email_send->send()) {
                                $id_user = $users->addUser($name, $email, $type_user, $id_group);
                                // adicionando o hash
                                $hashUsers->addHashUser($id_user, $hash_email);

                                $success = 'new_user';
                                header('Location: ' . BASE_URL . 'Users/index/' . $success);
                                exit;
                            } else {
                                $this->data["Erro"] = message()->warning("Ops, Verifique se o e-mail esta correto.");
                            }
                        } else {
                            $this->data["Erro"] = message()->warning("Ops, esse e-mail ja esta em uso.");
                        }
                    } else {
                        $this->data["Erro"] = message()->warning("Por favor, informe um email válido.");
                    }
                }
            }

            // Editando um usuário
            if (isset($_POST['id_user_edit']) && !empty($_POST['id_user_edit'])) {
                $id_user = addslashes($_POST['id_user_edit']);

                if (isset($_POST['name_edit']) && !empty($_POST['name_edit'])) {
                    $name_edit = addslashes($_POST['name_edit']);
                    if (empty(trim($name))) {
                        $erro = message()->warning('Não é possivel inserir espaços em brancos');
                    } else {
                        $users->editNameUser($name_edit, $id_user);
                    }
                }

                if (isset($_POST['situation']) && !empty($_POST['situation'])) {
                    $situation = addslashes($_POST['situation']);

                    if ($situation == 'act') {
                        $situation = 1;
                    } else {
                        $situation = 0;
                    }

                    $users->editSituationUser($situation, $id_user);
                }


                if (isset($_POST['id_group_edit']) && !empty($_POST['id_group_edit'])) {
                    $id_group_edit = addslashes($_POST['id_group_edit']);

                    $users->editGroupUser($id_group_edit, $id_user);
                }

                if (isset($_POST['email_edit']) && !empty($_POST['email_edit'])) {
                    $email_edit = addslashes($_POST['email_edit']);
                    $hash_email = md5($email_edit);

                    if (is_email($email_edit)) {
                        if (!$users->havePasswordRegistrer($id_user)) {
                            if (!$users->verifyEmail($email_edit)) {
                                $subject = "Login de Acesso";
                                $info = array();
                                $info['email'] = $email_edit;
                                $info['hash'] = $hash_email;

                                ob_start();
                                $this->loadView('Email/invite', $info);
                                $message = ob_get_clean();

                                $email_send->bootstrap($subject, $message, $email_edit, 'Usuário');

                                if ($email_send->send()) {
                                    $users->editEmailUser($email_edit, $id_user);
                                    $hashUsers->addHashUser($id_user, $hash_email);
                                } else {
                                    $erro = message()->warning("Ops, Verifique se o e-mail esta correto.");
                                }
                            } else {
                                $erro = message()->warning("Ops, esse e-mail ja esta cadastrado, verifique a caixa de spam.");
                            }
                        } else {
                            $erro = message()->warning("E-mail ja esta em uso, não é permitido edita-lo");
                        }
                    } else {
                        $erro = message()->warning("Por favor, informe um email vá  lido.");
                    }
                }

                if (isset($erro)) {
                    $this->data['Erro'] = $erro;
                } else {
                    $success = 'edit_user';
                    header('Location: ' . BASE_URL . 'Users/index/' . $success);
                    exit;
                }
            }

            $this->data['users_list'] = $users->getList();

            $permission = new Permissions();
            $this->data['permissions_list'] = $permission->getGroupList();

            $this->data['JS'] = '<script src="' . BASE_URL . 'Assets/js/datatables.js" type="text/javascript"></script>';
            $this->data['JS'] .= '
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					// Datatables Responsive
					$("#datatables-reponsive").DataTable({
						responsive: true
					});
				});
			</script>';

            $this->loadTemplateAdmin("Admin/Users/index", $this->data);
        } else {
            redirect('Home');
        }
    }
}
