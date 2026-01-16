<?php
class Income {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getByUser($userId) {
        $stmt = $this->db->prepare(
            "SELECT * FROM incomes WHERE user_id = :id"
        );
        $stmt->execute(['id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($amount, $categoryId, $userId) {
        $stmt = $this->db->prepare(
            "INSERT INTO incomes (amount, category_id, user_id)
             VALUES (:a, :c, :u)"
        );
        return $stmt->execute([
            'a' => $amount,
            'c' => $categoryId,
            'u' => $userId
        ]);
    }
}
