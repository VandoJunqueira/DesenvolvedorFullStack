<?php

namespace App\Services;

use App\Repositories\LinkRepository;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class LinkServices
{
    protected $repository;

    public function __construct(LinkRepository $repository)
    {
        $this->repository = $repository;
    }

    // Função para filtrar os links
    public function filter()
    {
        return $this->repository->filter();
    }

    // Função para armazenar um novo link
    public function store(array $data)
    {
        $url = $data['long_link'];
        $slug = $data['slug'] ?? null;

        // Se não houver um slug definido, gera um slug aleatório
        if (!$slug) {
            $slug = $this->createSlug();
        }

        $user = auth()->user();

        // Obtém informações do site usando WebScrapingServices
        $web_site_info = WebScrapingServices::getWebsiteInfo($url);

        // Cria um novo link associado ao usuário
        $link = $user->links()->create([
            'long_link' => $url,
            'slug' => $slug,
            'title' => $data['title'] ?? $web_site_info->title,
            'favicon' => $web_site_info->favicon
        ]);

        return $link;
    }

    public function update(string $id, array $data)
    {
        $user = auth()->user();

        // Verifica se o link pertence ao usuário antes de atualizá-lo
        if (!$this->repository->findLinkByIdAndUser($id, $user->id)) {
            throw new \Exception('Link não encontrado ou não pertence ao usuário.', 404);
        }

        return $this->repository->update($id, $data);
    }

    public function find(string $id)
    {

        $user = auth()->user();

        // Verifica se o link pertence ao usuário
        if (!$link = $this->repository->findLinkByIdAndUser($id, $user->id)) {
            throw new \Exception('Link não encontrado ou não pertence ao usuário.', 404);
        }

        return $link;
    }

    public function findBySlug(string $slug)
    {
        $user = auth()->user();

        // Verifica se o link pertence ao usuário
        if (!$link = $this->repository->findLinkBySlugAndUser($slug, $user->id)) {
            throw new \Exception('Link não encontrado ou não pertence ao usuário.', 404);
        }

        return $link;
    }

    public function count()
    {
    }

    public function metric(string $slug)
    {
        // Encontra o link correspondente ao slug fornecido
        if (!$link = $this->repository->findLinkBySlug($slug)) {
            throw new \Exception('Link não encontrado.', 404);
        }

        // Incrementa o contador de acessos do link
        $link->hit_counter++;
        $link->save();

        $agent = new Agent(); //Usado para obter o navegador e o sistema do usuario

        // Cria uma nova métrica para o link, registrando informações do acesso
        $link->metrics()->create([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'browsers' => $agent->browser(),
            'system' => $agent->platform()
        ]);

        return $link;
    }

    // Função para verificar se um slug já existe
    public function checkSlug(string $slug)
    {
        return $this->repository->checkSlug($slug);
    }

    // Função para criar um slug único
    private function createSlug()
    {
        $slug = Str::random(random_int(6, 8));

        // Caso o slug aleatório já exista, tenta criar novamente.
        if ($this->checkSlug($slug)) {
            $slug = $this->createSlug();
        }
        return $slug;
    }

    public function destroy(string $id)
    {
        $user = auth()->user();

        // Verifica se o link pertence ao usuário antes de excluir.
        if (!$this->repository->findLinkByIdAndUser($id, $user->id)) {
            throw new \Exception('Link não encontrado ou não pertence ao usuário.', 404);
        }

        $this->repository->destroy($id);
    }
}
