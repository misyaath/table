<?php

namespace App\Kafka;

use RdKafka\Conf;

class KafkaConfig
{

    protected array $configs;
    protected string $securityProtocol;
    protected array $sasl;
    final const SASL_PLAINTEXT = 'SASL_PLAINTEXT';
    final const SASL_SSL = 'SASL_SSL';
    final const PRODUCER_ONLY_CONFIG_OPTIONS = [
        'transactional.id',
        'transaction.timeout.ms',
        'enable.idempotence',
        'enable.gapless.guarantee',
        'queue.buffering.max.messages',
        'queue.buffering.max.kbytes',
        'queue.buffering.max.ms',
        'linger.ms',
        'message.send.max.retries',
        'retries',
        'retry.backoff.ms',
        'queue.buffering.backpressure.threshold',
        'compression.codec',
        'compression.type',
        'batch.num.messages',
        'batch.size',
        'delivery.report.only.error',
        'dr_cb',
        'dr_msg_cb',
        'sticky.partitioning.linger.ms',
    ];
    final const CONSUMER_ONLY_CONFIG_OPTIONS = [
        'partition.assignment.strategy',
        'session.timeout.ms',
        'heartbeat.interval.ms',
        'group.protocol.type',
        'coordinator.query.interval.ms',
        'max.poll.interval.ms',
        'enable.auto.commit',
        'auto.commit.interval.ms',
        'enable.auto.offset.store',
        'queued.min.messages',
        'queued.max.messages.kbytes',
        'fetch.wait.max.ms',
        'fetch.message.max.bytes',
        'max.partition.fetch.bytes',
        'fetch.max.bytes',
        'fetch.min.bytes',
        'fetch.error.backoff.ms',
        'offset.store.method',
        'isolation.level',
        'consume_cb',
        'rebalance_cb',
        'offset_commit_cb',
        'enable.partition.eof',
        'check.crcs',
        'allow.auto.create.topics',
        'auto.offset.reset',
    ];

    public function __construct(protected Conf $conf)
    {
    }

    public function setConfigs(array $configs): self
    {
        $this->configs = $configs;
        $this->commonConfig($configs);
        return $this;
    }

    public function getProducerConfig(): Conf
    {
        return $this->conf;
    }

    public function getConsumerConfig()
    {
        $options = [
            'metadata.broker.list' => $this->broker,
            'auto.offset.reset' => config('kafka.offset_reset', 'latest'),
            'enable.auto.commit' => config('kafka.auto_commit', true) === true ? 'true' : 'false',
            'group.id' => $this->groupId,
            'bootstrap.servers' => $this->broker,
        ];

        if (isset($this->autoCommit)) {
            $options['enable.auto.commit'] = $this->autoCommit === true ? 'true' : 'false';
        }

        return collect(array_merge($options, $this->getSaslOptions()))
            ->reject(fn(string|int $option, string $key) => in_array($key, self::PRODUCER_ONLY_CONFIG_OPTIONS))
            ->toArray();
    }

    private function getSaslOptions(): array
    {
        if ($this->usingSasl()) {
            return [
                'sasl.username' => $this->sasl->getUsername(),
                'sasl.password' => $this->sasl->getPassword(),
                'sasl.mechanisms' => $this->sasl->getMechanisms(),
                'security.protocol' => $this->sasl->getSecurityProtocol(),
            ];
        }

        return [];
    }

    private function usingSasl(): bool
    {
        return (strtoupper($this->securityProtocol) === static::SASL_PLAINTEXT
            || strtoupper($this->securityProtocol) === static::SASL_SSL);
    }

    protected function commonConfig(): void
    {
        $this->securityProtocol = $this->configs['securityProtocol'];
        $this->sasl = $this->configs['sasl'];
        $this->conf->set('metadata.broker.list', $this->configs['brokers']);
        $this->conf->set('bootstrap.servers', $this->configs['brokers']);
        $this->conf->set('security.protocol', $this->configs['securityProtocol']);
        $this->conf->set('sasl.mechanisms', $this->configs['sasl']['mechanisms']);
        $this->conf->set('sasl.username', $this->configs['sasl']['username']);
        $this->conf->set('sasl.password', $this->configs['sasl']['password']);
        $this->conf->set('queue.buffering.max.ms', 1);
        $this->conf->set('enable.auto.commit', $this->configs['auto_commit']);
        $this->conf->set('compression.type', $this->configs['compression']);
        $this->conf->set('log_level', LOG_DEBUG);
    }
}