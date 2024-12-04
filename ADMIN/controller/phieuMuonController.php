<?php
require_once __DIR__ . '/../model/phieumuon.php';


class PhieuMuonController
{
  private $model;

  // Khởi tạo Controller với model
  public function __construct($db)
  {
    $this->model = new PhieuMuonModel($db);
  }

  // Hàm tìm kiếm phiếu mượn
  public function searchPM()
  {
    if (isset($_GET['idPM'])) {
      $idPM = $_GET['idPM'];

      // Gọi hàm getPM trong model
      $phieuMuon = $this->model->getPM($idPM);

      if ($phieuMuon) {
        $data = json_encode($phieuMuon);
        header("Location: ../view/order/chiTietPhieuMuon.php?data=" . urlencode($data));
      } else {
        header("Location: ../view/order/formTimKiem.php?error=" . urlencode("Không có phiếu mượn nào phù hợp."));
      }
      exit();
    } else {
      header("Location: ../view/order/formTimKiem.php?error=Không tìm thấy mã phiếu mượn.");
    }
  }
}

// // Khởi tạo đối tượng Controller và xử lý
// require_once __DIR__ . '../database/db_connect.php'; // Lấy kết nối
// $controller = new PhieuMuonController($conn);

// if (isset($_GET['action']) && $_GET['action'] === 'searchPM') {
//   $controller->searchPM();
// }
