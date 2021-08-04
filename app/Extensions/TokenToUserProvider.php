<?php namespace App\Extensions;

use App\Models\Store;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Str;

class TokenToUserProvider implements UserProvider
{
	private $store;
	private $user;

	public function __construct (User $user, Store $store) {
		$this->user = $user;
		$this->store = $store;
	}

	public function retrieveById ($identifier) {
		return $this->user->find($identifier);
	}

	public function retrieveByToken ($identifier, $token) {
		$token = $this->store->with('user')->where($identifier, $token)->first();

		return $token && $token->user ? $token->user : null;
	}

	public function updateRememberToken (Authenticatable $user, $token) {
		// update via remember token not necessary
	}

	public function retrieveByCredentials (array $credentials) {
		// implementation upto user.
		// how he wants to implement -
		// let's try to assume that the credentials ['username', 'password'] given
		$user = $this->user;
		foreach ($credentials as $credentialKey => $credentialValue) {
			if (!Str::contains($credentialKey, 'password')) {
				$user->where($credentialKey, $credentialValue);
			}
		}

		return $user->first();
	}

	public function validateCredentials (Authenticatable $user, array $credentials) {
		$plain = $credentials['password'];

		return app('hash')->check($plain, $user->getAuthPassword());
	}
}