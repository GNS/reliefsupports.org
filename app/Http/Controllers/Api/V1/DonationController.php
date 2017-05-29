<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\DonationRepository;
use Illuminate\Http\Request;

class  DonationController extends ApiController {


    private $donation;

    public function __construct(DonationRepository $donation)
    {
        $this->donation = $donation;
    }


    /**
     * Get All request with a default limit, or send additional requests limit and query as q
     *
     * @param Request $request
     * @param null $limit
     * @return mixed
     */
    public function index(Request $request, $limit = null)
    {
        if ($request->has('limit')) {
            $limit = $request->get('limit');
        }

        $data = $this->donation;

        if ($request->has('q')) {
            $query = $request->get('q');

            $data = $data->findDonation($query);
        }

        $data = $data->getDonations($limit);

        return $this->respond($data);
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function show(Request $request, $id)
    {
        $data = $this->donation->findDonation($id);

        return $this->respond($data);
    }


    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

    }
}