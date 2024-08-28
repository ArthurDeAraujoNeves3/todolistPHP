<?php
class PermissionsController extends Controller
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

	public function index()
	{
		$this->data['nivel-1'] = 'Configurações';
		$this->data['nivel-2'] = "Permissões";


		$user = new Users();
		$user->setLoggedUser();

		// verifying if the users have access permission
		if ($user->hasPermission('add_permission')) {

			$permission = new Permissions();
			$this->data['group_list'] = $permission->getGroupList();
			$this->data['params_list'] = $permission->getList();

			// create permission group
			if (isset($_POST['group_name']) && !empty($_POST['group_name']) && isset($_POST['params']) && !empty($_POST['params'])) {
				$name = addslashes($_POST['group_name']);
				$permission_list = $_POST['params'];

				// insert new group in dataBase
				$permission->addGroup($name, $permission_list);

				header("Location: " . BASE_URL . 'Permissions');
				exit;
			}

			// Update permission group
			if (isset($_POST['group_name_edit']) && !empty($_POST['group_name_edit']) && isset($_POST['params_edit']) && !empty($_POST['params_edit']) && isset($_POST['id_group']) && !empty($_POST['id_group'])) {
				$name = addslashes($_POST['group_name_edit']);
				$permission_list = $_POST['params_edit'];
				$id_group = $_POST['id_group'];

				// insert new group in dataBase
				$permission->editGroup($name, $permission_list, $id_group);

				header("Location: " . BASE_URL . 'Permissions');
				exit;
			}


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


			$this->loadTemplateAdmin("Admin/Permissions/index", $this->data);
		} else {
			redirect('Home');
		}
	}


	public function addParams()
	{
		$this->data['nivel-1'] = 'Configurações';
		$this->data['nivel-2'] = "Permissões";


		$user = new Users();
		$user->setLoggedUser();

		// verifying if the users have access permission
		if ($user->hasPermission('add_params')) {

			$permission = new Permissions();
			$this->data['params_list'] = $permission->getList();

			if (isset($_POST['params_name']) && !empty($_POST['params_name']) && isset($_POST['params_description']) && !empty($_POST['params_description'])) {
				$name = addslashes($_POST['params_name']);
				$description = addslashes($_POST['params_description']);

				if ($permission->addParams($name, $description)) {
					header("Location: " . BASE_URL . "Permissions/addParams");
					exit;
				} else {
					$this->data['Erro'] = "Não foi possivel adicionar o parâmetro, tente novamente mais tarde";
				}
			}

			if (isset($_POST['params_name_edit']) && !empty($_POST['params_name_edit']) && isset($_POST['params_description_edit']) && !empty($_POST['params_description_edit']) && isset($_POST['id_params']) && !empty($_POST['id_params'])) {
				$name = addslashes($_POST['params_name_edit']);
				$description = addslashes($_POST['params_description_edit']);
				$id_params = addslashes($_POST['id_params']);

				if ($permission->editParams($name, $description, $id_params)) {
					header("Location: " . BASE_URL . "Permissions/addParams");
					exit;
				} else {
					$this->data['Erro'] = "Não foi possivel adicionar o parâmetro, tente novamente mais tarde";
				}
			}

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

			$this->loadTemplateAdmin("Admin/Permissions/params", $this->data);
		} else {
			redirect('Home');
		}
	}
}
