<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ZoomApiService {
    protected $client;
    protected $apiUrl;

    public function __construct() {
        $this->client = new Client();
        $this->apiUrl = config( 'zoom.api_url' );
    }

    public function getAccessToken( $code ) {
        $params = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => config( 'zoom.redirect_uri' ),
            'client_id' => config( 'zoom.client_id' ),
            'client_secret' => config( 'zoom.client_secret' ),
        ];

        $response = $this->client->post( 'https://zoom.us/oauth/token', [ 'form_params' => $params ] );
        $responseData = json_decode( $response->getBody()->getContents(), true );

        if ( !isset( $responseData[ 'access_token' ] ) ) {
            throw new \Exception( 'Failed to obtain access token' );
        }

        Session::put( 'zoom_access_token', $responseData[ 'access_token' ] );
        return $responseData[ 'access_token' ];
    }

    public function RefreshAccessToken() {
        session()->forget( 'zoom_access_token' );
        return redirect()->route( 'zoom.index' )->with( 'error', 'zoom_access_token refresh' );
    }

    public function index() {
        try {
            if ( !session( 'zoom_access_token' ) ) {
                $authorizeUrl = config( 'zoom.authorize_url' );
                return redirect( $authorizeUrl );
            } else {
                $accessToken = session( 'zoom_access_token' );
            }

            $userId = 'me';
            // or use a specific user ID if known
            $client = new Client();
            $response = $client->get( config( 'zoom.api_url' ) . "users/{$userId}/meetings", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
            ] );

            $meetings = json_decode( $response->getBody()->getContents(), true );
            return view( 'crm.zoom.index', [ 'meetings' => $meetings[ 'meetings' ] ] );
        } catch ( \Throwable $th ) {
            return $this->RefreshAccessToken();
        }
    }

    public function getMeetings() {
        try {
            if ( !session( 'zoom_access_token' ) ) {
                $authorizeUrl = config( 'zoom.authorize_url' );
                return redirect( $authorizeUrl );
            } else {
                $accessToken = session( 'zoom_access_token' );
            }

            $userId = 'me';
            // or use a specific user ID if known
            $client = new Client();
            $response = $client->get( config( 'zoom.api_url' ) . "users/{$userId}/meetings", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
            ] );

            $meetings = json_decode( $response->getBody()->getContents(), true );
            return  $meetings[ 'meetings' ];

            // return view( 'crm.zoom.index', [ 'meetings' => $meetings[ 'meetings' ] ] );
        } catch ( \Throwable $th ) {
            return $this->RefreshAccessToken();
        }

    }

    public function createMeeting( $data ) {
        try {
            $accessToken = Session::get( 'zoom_access_token' );

            $response = $this->client->post( "{$this->apiUrl}users/me/meetings", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ] );

            return json_decode( $response->getBody()->getContents(), true );

        } catch ( \Throwable $th ) {
            return $this->RefreshAccessToken();

        }
    }

    public function getMeeting( $meetingId ) {
        try {
            $accessToken = Session::get( 'zoom_access_token' );

            $response = $this->client->get( "{$this->apiUrl}meetings/{$meetingId}", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
            ] );

            return json_decode( $response->getBody()->getContents(), true );
        } catch ( \Throwable $th ) {
            return $this->RefreshAccessToken();
        }
    }

    public function updateMeeting( $meetingId, $data ) {
        try {
            $accessToken = Session::get( 'zoom_access_token' );

            $response = $this->client->patch( "{$this->apiUrl}meetings/{$meetingId}", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ] );

            $responseData = json_decode( $response->getBody()->getContents(), true );
        } catch ( \Throwable $th ) {
            return $this->RefreshAccessToken();
        }

    }

    public function deleteMeeting( $meetingId ) {
        try {
            $accessToken = Session::get( 'zoom_access_token' );

            $response = $this->client->delete( "{$this->apiUrl}meetings/{$meetingId}", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
            ] );

            return $response->getStatusCode() === 204;
        } catch ( \Throwable $th ) {
            return $this->RefreshAccessToken();

        }
    }
}
