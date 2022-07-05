<?php

class baseModel
{

    public function getFbStockProductActive($conn, $idMag)
    {
        $query = "SELECT k.id_kartoteka, k.indeks, k.nazwadl, sm.standysp, sm.stan from kartoteka k
        LEFT join stanmag sm on (k.id_kartoteka = sm.id_kartoteka AND sm.id_magazyn = {$idMag})
        WHERE k.aktywny=1
        AND k.id_rodzajkart=1";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getFbStockProductIndeks($conn,$indeks,$idMag)
    {
        $query = "SELECT k.id_kartoteka, k.indeks, k.nazwadl, CAST(sm.standysp AS numeric(10,0)) as standysp, CAST(sm.stan AS numeric(10,0)) as stan from kartoteka k
        LEFT join stanmag sm on (k.id_kartoteka = sm.id_kartoteka AND sm.id_magazyn = {$idMag})
        WHERE k.aktywny=1
        AND k.id_rodzajkart=1
        AND k.indeks = '{$indeks}'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result[0])) {
            $res['ID_KARTOTEKA'] = NULL;
            $res['INDEKS'] = NULL;
            $res['NAZWADL'] = NULL;
            $res['STANDYSP'] = NULL;
            $res['STAN'] = NULL;
            return $res;
        } 
        else {return $result[0];}
        //return $result[0];
    }
}